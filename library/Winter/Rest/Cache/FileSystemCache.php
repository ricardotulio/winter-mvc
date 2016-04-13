<?php
namespace Winter\Rest\Cache;

use Exception;
use Winter\Rest\Router\Router;

/**
 * Classe responsável por gerenciar o cache de rotas em arquivo
 *
 * @author Ricardo Ledo de Tulio <ledo.tulio@gmail.com>
 * @package Winter\Rest\Cache
 * @version 0.1.0
  */
class FileSystemCache implements Cache
{
    
    /**
     * Namespace da classe de cache
     * 
     * @var string
     */
    const CACHE_NAMESPACE = "Winter\Rest\Cache\__CACHE__";
    
    /**
     * Nome da classe de cache
     * 
     * @var string
     */
    const CACHE_CLASS = "FileSystemCache";

    /**
     * Local do arquivo de cache
     * 
     * @var string
     */
    private $cachePath;
    
    /**
     * Conteúdo do arquivo que contém a classe de cache
     * 
     * @var string
     */
    private $fileContents = '';

    /**
     * Construtor padrão
     *
     * @author Ricardo Ledo de Tulio <ledo.tulio@gmail.com>
     * @param string $cacheDir            
     * @throws Exception
     */
    public function __construct($cacheDir)
    {
        if (! file_exists($cacheDir) || ! is_writable($cacheDir))
            throw new Exception("Diretório de cache inválido!");
        
        $this->cachePath = $cacheDir . DIRECTORY_SEPARATOR . self::CACHE_CLASS . '.php';
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Winter\Mvc\Cache\Cache::hasCache()
     */
    public function hasCache()
    {
        if(!file_exists($this->cachePath))
            return false;
        
        require_once($this->cachePath);
        return class_exists(self::CACHE_NAMESPACE . '\\' . self::CACHE_CLASS);
    }

    public function start() 
    {
        if(!file_exists($this->cachePath));
            touch($this->cachePath);
        
        $namespace = self::CACHE_NAMESPACE;
        $class = self::CACHE_CLASS;
        $this->fileContents .= <<<EOF
<?php
            
namespace $namespace;
    
use Winter\Rest\Router\Router;

class $class {
    
    public function load(Router \$router) 
    {
EOF;
    }
        
    /**
     *
     * {@inheritDoc}
     *
     * @see \Winter\Mvc\Cache\Cache::addRoute()
     */
    public function addRoute($method, $routePath, $routeTarget)
    {        
        $this->fileContents .= "\n\t\$router->{$method}(\"{$routePath}\", \"{$routeTarget}\");";
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Winter\Mvc\Cache\Cache::end()
     */
    public function end() 
    {
        $this->fileContents .= "\n    }";
        $this->fileContents .= "\n}";
        file_put_contents($this->cachePath, $this->fileContents);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Winter\Mvc\Cache\Cache::load()
     */
    public function load(Router $router)
    {
        require_once $this->cachePath;
        $cacheClass = self::CACHE_NAMESPACE . '\\' . self::CACHE_CLASS;
        $cache = new $cacheClass();
        $cache->load($router);
    }
}