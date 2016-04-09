<?php
namespace Winter\Mvc\Annotations;

use ReflectionClass;
use Exception;
use Doctrine\Common\Annotations\AnnotationReader;
use Respect\Rest\Router;

/**
 * Classe respons�vel por prover m�todos para varredura do sistema de arquivos
 * em busca de classes que possuam as anota��es Winter\Mvc\Annotations\Controller e
 * Winter\Mvc\Annotations\RequestMapping
 *
 * @author Ricardo
 * @package Winter\Mvc\Annotations
 * @version 0.1.0
 */
class FileReader implements Reader
{

    /**
     * Nome do arquivo de cache
     *
     * @var string
     */
    const CACHE_FILE = "__cacherouter.php";
    
    /**
     * Tempo de dura��o do cache de rotas em segundos  
     * 
     * @var int 
     */
    const CACHE_TIME = 5 * 60;

    /**
     * Leitor de docblocs/anota��es
     *
     * @var Doctrine\Common\Annotations\AnnotationReader
     */
    private $annotationReader;

    /**
     * Router da aplica��o
     *
     * @var Respect\Rest\Router
     */
    private $router;

    /**
     * Namespace que ser� varrido
     *
     * @var string
     */
    private $namespace;

    /**
     * Diret�rio onde se encontra as classes do namespace
     *
     * @var string
     */
    private $path;

    /**
     * Diret�rio do arquivo de cache
     *
     * @var string
     */
    private $cacheDir;

    /**
     * Arquivo de cache da aplica��o
     *
     * @var string
     */
    private $cacheFile;

    /**
     * Construtor padr�o
     *
     * @param AnnotationReader $annotationReader            
     * @param Router $router            
     * @param array $config            
     * @throws Exception
     */
    public function __construct(AnnotationReader $annotationReader, Router $router, array $config)
    {
        $this->annotationReader = $annotationReader;
        $this->router = $router;
        
        if (! isset($config['namespace']) || ! isset($config['path']))
            throw new Exception("Configura��o inv�lida");
        
        if (isset($config['cacheDir'])) {
            $this->cacheDir = $config['cacheDir'];
            $this->cacheFile = $this->cacheDir . DIRECTORY_SEPARATOR . self::CACHE_FILE;
        }
        
        $this->namespace = $config['namespace'];
        $this->path = $config['path'];
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Winter\Mvc\Annotations\Reader::read()
     */
    public function read()
    {
        $cache = $this->loadCache();

        if(!$cache) {
            $this->validatePath($this->path);
            $this->readDirectory($this->namespace, $this->path);
        }
    }

    /**
     * Metodo respons�vel por verificar se o diret�rio � v�lido
     *
     * @param string $path            
     * @version 0.1.0
     * @throws Exception
     */
    private function validatePath($path)
    {
        if (! file_exists($path) || ! is_readable($path))
            throw new Exception("Path informado inv�lido.");
    }

    /**
     * Metodo respons�vel varrer o diret�rio em busca de classes
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
                $filePath = $namespace . DIRECTORY_SEPARATOR . $file;
                $this->readFile($filePath);
            }
        }
    }

    /**
     * Metodo respons�vel varrer um arquivo em busca de classes
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
                
                if ($this->isController($reflection)) {
                    $this->route($reflection);
                }
            }
        }
    }

    /**
     * M�todo respons�vel por verificar se a classe em quest�o � uma classe
     * controladora, ou seja, possui a anota��o \Winter\Mvc\Annotations\Controller
     *
     * @param ReflectionClass $obj            
     * @version 0.1.0
     * @return boolean
     */
    private function isController(ReflectionClass $obj)
    {
        return ($this->annotationReader->getClassAnnotation($obj, "Controller") !== null);
    }

    /**
     * M�todo respons�vel por rotear o controller
     *
     * @param ReflectionClass $obj            
     * @version 0.1.0
     */
    private function route(ReflectionClass $obj)
    {
        $requestMapping = $this->annotationReader->getClassAnnotation($obj, "\Winter\Mvc\Annotations\RequestMapping");
        $routePath = $requestMapping !== null ? $requestMapping->value : '/' . strtolower(str_replace("\\", "/", $obj->getName()));
        $routeTarget = $obj->getName();
        $this->router->any($routePath, $routeTarget);
    }

    /**
     * @return boolean
     * @todo Verificar se o atributo $cacheFile � diferente de nulo, ou seja, foi passado as informa��es para cache
     * depois disso, verificar se o arquivo de cache j� existe. Caso exista, carreg�-lo. Caso n�o exista, verificar se 
     * o diret�rio passado � grav�vel, se n�o for, lan�ar exce��o. Se for, criar arquivo de cache.
     * 
     * @todo Verificar h� quanto tempo esse arquivo foi modificado e sobreescrever o cache caso seja necess�rio atualiza��o
     * 
     * @todo Dentro do arquivo de cache criado 
     */
    private function loadCache()
    {
        $arquivoCache = <<<EOF
       
        namespace \Winter\Mvc\Annotations\Cache;
            
        class Cache()  {
            
            private \$router;
            
            public function __construct(\Respect\Rest\Router \$router) {
                \$this->router = \$router;
            }
            
            public function init() {
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
                \$this->router->any("", "");
            }
            
        }
EOF;

        $cache = new \Winter\Mvc\Annotations\Cache\Cache($this->router);
        $cache->load();
    }
} 