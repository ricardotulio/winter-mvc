<?php
namespace Winter\Rest\Router;

/**
 * Interface respons�vel por prover m�todos para roteamento
 * da aplica��o
 *
 * @author Ricardo Ledo de Tulio
 * @package Winter\Rest\Router 
 * @version 0.1.0       
 */
interface Router
{

    /**
     * M�todo respons�vel por criar uma rota para atender 
     * requisi��es HTTP do tipo GET
     * 
     * @param string $path
     * @param string|function $target
     */
    public function get($path, $target);

    /**
     * M�todo respons�vel por criar uma rota para requisi��es
     * HTTP do tipo POST
     *
     * @param string $path
     * @param string|function $target
     */
    public function post($path, $target);

    /**
     * M�todo respons�vel por criar uma rota para atender 
     * requisi��es HTTP do tipo PUT
     *
     * @param string $path
     * @param string|function $target
     */
    public function put($path, $target);

    /**
     * M�todo respons�vel por criar uma rota para atender
     * requisi��es HTTP do tipo DELETE
     *
     * @param string $path
     * @param string|function $target
     */
    public function delete($path, $target);

    /**
     * M�todo respons�vel por criar uma rota para atender 
     * requisi��es HTTP GET, POST, PUT e DELETE
     *
     * @param string $path
     * @param string|function $target
     */
    public function any($path, $target);
}