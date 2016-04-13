<?php
namespace Winter\Rest\Router;

class RespectRouterAdapter implements Router
{

    private $router;

    public function __construct()
    {
        $this->router = new \Respect\Rest\Router();
        $this->router->isAutoDispatched = false;
    }

    /**
     * Método responsável por criar uma rota para atender
     * requisições HTTP do tipo GET
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function get($path, $target)
    {
        $this->router->get($path, function () use($target) {
            $controller = new $target();
            return $controller->get();
        });
    }

    /**
     * Método responsável por criar uma rota para requisições
     * HTTP do tipo POST
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function post($path, $target)
    {
        $this->router->post($path, function () use($target) {
            $controller = new $target();
            return $controller->post();
        });
    }

    /**
     * Método responsável por criar uma rota para atender
     * requisições HTTP do tipo PUT
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function put($path, $target)
    {
        $this->router->put($path, function () use($target) {
            $controller = new $target();
            return $controller->put();
        });
    }

    /**
     * Método responsável por criar uma rota para atender
     * requisições HTTP do tipo DELETE
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function delete($path, $target)
    {
        $this->router->delete($path, function () use($target) {
            $controller = new $target();
            return $controller->delete();
        });
    }

    /**
     * Método responsável por criar uma rota para atender
     * requisições HTTP GET, POST, PUT e DELETE
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function any($path, $target)
    {
        $this->get($path, $target);
        $this->post($path, $target);
        $this->put($path, $target);
        $this->delete($path, $target);
    }

    /**
     * Método responsável por executar o roteamento da aplicação
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function run()
    {
        echo $this->router->run();
    }
}