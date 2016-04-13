<?php
namespace Winter\Rest\Router;

class RespectRouterAdapter implements Router
{

    private $router;

    public function __construct()
    {
        $this->router = new \Respect\Rest\Router();
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
        $this->router->get($path, $target);
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
        $this->router->post($path, $target);
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
        $this->router->put($path, $target);
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
        $this->router->delete($path, $target);
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
        $this->router->any($path, $target);
    }
}