<?php
namespace Winter\Rest\Router;

/**
 * Interface responsсvel por prover mщtodos para roteamento
 * da aplicaчуo
 *
 * @author Ricardo Ledo de Tulio
 * @package Winter\Rest\Router 
 * @version 0.1.0       
 */
interface Router
{

    /**
     * Mщtodo responsсvel por criar uma rota para atender 
     * requisiчѕes HTTP do tipo GET
     * 
     * @param string $path
     * @param string|function $target
     */
    public function get($path, $target);

    /**
     * Mщtodo responsсvel por criar uma rota para requisiчѕes
     * HTTP do tipo POST
     *
     * @param string $path
     * @param string|function $target
     */
    public function post($path, $target);

    /**
     * Mщtodo responsсvel por criar uma rota para atender 
     * requisiчѕes HTTP do tipo PUT
     *
     * @param string $path
     * @param string|function $target
     */
    public function put($path, $target);

    /**
     * Mщtodo responsсvel por criar uma rota para atender
     * requisiчѕes HTTP do tipo DELETE
     *
     * @param string $path
     * @param string|function $target
     */
    public function delete($path, $target);

    /**
     * Mщtodo responsсvel por criar uma rota para atender 
     * requisiчѕes HTTP GET, POST, PUT e DELETE
     *
     * @param string $path
     * @param string|function $target
     */
    public function any($path, $target);
}