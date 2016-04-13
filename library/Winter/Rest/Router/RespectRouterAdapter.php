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
     * M�todo respons�vel por criar uma rota para atender
     * requisi��es HTTP do tipo GET
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
     * M�todo respons�vel por criar uma rota para requisi��es
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
     * M�todo respons�vel por criar uma rota para atender
     * requisi��es HTTP do tipo PUT
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
     * M�todo respons�vel por criar uma rota para atender
     * requisi��es HTTP do tipo DELETE
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
     * M�todo respons�vel por criar uma rota para atender
     * requisi��es HTTP GET, POST, PUT e DELETE
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
     * M�todo respons�vel por executar o roteamento da aplica��o
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function run()
    {
        echo $this->router->run();
    }
}