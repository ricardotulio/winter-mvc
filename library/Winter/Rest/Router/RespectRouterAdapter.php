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
     * Método responsável por criar uma rota para atender
     * requisições HTTP do tipo GET
     *
     * @param string $path            
     * @param string|function $target            
     */
    public function get($path, $target)
    {
        $this->router->get($path, $target);
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
        $this->router->post($path, $target);
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
        $this->router->put($path, $target);
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
        $this->router->delete($path, $target);
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
        $this->router->any($path, $target);
    }
}