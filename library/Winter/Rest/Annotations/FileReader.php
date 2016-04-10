<?php
namespace Winter\Rest\Annotations;

use ReflectionClass;
use Exception;
use Doctrine\Common\Annotations\AnnotationReader;
use Respect\Rest\Router;
use Winter\Rest\Cache\Cache;

/**
 * Classe responsável por prover métodos para varredura do sistema de arquivos
 * em busca de classes que possuam as anotações Winter\Mvc\Annotations\Controller e
 * Winter\Mvc\Annotations\RequestMapping
 *
 * @author Ricardo
 * @package Winter\Rest\Annotations
 * @version 0.1.0
 */
class FileReader implements Reader
{

    /**
     * Leitor de docblocs/anotações
     *
     * @var Doctrine\Common\Annotations\AnnotationReader
     */
    private $annotationReader;

    /**
     * Router da aplicação
     *
     * @var Respect\Rest\Router
     */
    private $router;

    /**
     * Namespace que será varrido
     *
     * @var string
     */
    private $namespace;

    /**
     * Diretório onde se encontra as classes do namespace
     *
     * @var string
     */
    private $path;

    /**
     * Cache de rotas
     *
     * @var string
     */
    private $cache;
    
    /**
     * Define se a execução está em modo debug ou não
     * 
     * @var boolean
     */
    private $debug;

    /**
     * Construtor padrão
     *
     * @param AnnotationReader $annotationReader            
     * @param Router $router            
     * @param array $config            
     * @throws Exception
     */
    public function __construct(AnnotationReader $annotationReader, Router $router, Cache $cache = null, array $config)
    {
        $this->annotationReader = $annotationReader;
        $this->router = $router;
        
        if (! isset($config['namespace']) || ! isset($config['path']))
            throw new Exception("Configuração inválida");
        
        if ($cache !== null) {
            $this->cache = $cache;
        }
        
        $this->namespace = $config['namespace'];
        $this->path = $config['path'];
        $this->debug = isset($config['debug']) ? $config['debug'] : false;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Winter\Mvc\Annotations\Reader::read()
     */
    public function read()
    {
        if($this->cache != null && !$this->debug) {
            if(!$this->cache->hasCache()) {
                $this->cache->start();
                $this->validatePath($this->path);
                $this->readDirectory($this->namespace, $this->path);
                $this->cache->end();
            } else {
                $this->cache->load($this->router);                
            }
        } else {
            $this->validatePath($this->path);
            $this->readDirectory($this->namespace, $this->path);            
        }
    }

    /**
     * Metodo responsável por verificar se o diretório é válido
     *
     * @param string $path            
     * @version 0.1.0
     * @throws Exception
     */
    private function validatePath($path)
    {
        if (! file_exists($path) || ! is_readable($path))
            throw new Exception("Path informado inválido.");
    }

    /**
     * Metodo responsável varrer o diretório em busca de classes
     *
     * @param string $path            
     * @version 0.1.0
     */
    private function readDirectory($namespace, $path)
    {
        $dir = dir($path);
        
        while (($file = $dir->read()) !== FALSE) {
            if ($file == "." || $file == "..") {
                continue;
            }
            
            $filePath = $path . DIRECTORY_SEPARATOR . $file;
            
            if (is_dir($filePath)) {
                $this->readDirectory("$namespace\\$file", $filePath);
            } else {
                $filePath = $namespace . '\\' . $file;
                $this->readFile($filePath);
            }
        }
    }

    /**
     * Metodo responsável varrer um arquivo em busca de classes
     *
     * @param string $filePath            
     * @version 0.1.0
     */
    private function readFile($filePath)
    {
        if (preg_match('/.php$/', $filePath)) {
            $className = substr($filePath, 0, - 4);
            
            if (class_exists($className)) {
                $reflection = new ReflectionClass($className);
                
                if ($this->isResource($reflection)) {
                    $this->route($reflection);
                }
            }
        }
    }

    /**
     * Método responsável por verificar se a classe em questão é uma classe
     * controladora, ou seja, possui a anotação \Winter\Mvc\Annotations\Controller
     *
     * @param ReflectionClass $obj            
     * @version 0.1.0
     * @return boolean
     */
    private function isResource(ReflectionClass $obj)
    {
        return ($this->annotationReader->getClassAnnotation($obj, "\Winter\Rest\Annotations\Path") !== null);
    }

    /**
     * Método responsável por rotear o controller
     *
     * @param ReflectionClass $obj            
     * @version 0.1.0
     */
    private function route(ReflectionClass $obj)
    {
        $path = $this->annotationReader->getClassAnnotation($obj, "\Winter\Rest\Annotations\Path");
        $routePath = $path->value;
        $routeTarget = $obj->getName();
        $this->router->any($routePath, $routeTarget);
        
        if ($this->cache !== null) {
            $this->cache->addRoute('any', $routePath, $routeTarget);
        }
    }
} 