<?php
namespace Winter\Rest\Cache;

use Winter\Rest\Router\Router;

/**
 * Interface respons�vel por prover m�todos para manipula��o de cache
 * de rotas
 * 
 * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
 * @version 0.1.0
 * @package Winter\Rest\Cache
 */
interface Cache
{

    /**
     * M�todo respons�vel por verificar se o cache j� foi carregado
     * 
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function hasCache();

    /**
     * M�todo respons�vel por iniciar a constru��o do cache
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function start();
    
    /**
     * M�todo respons�vel por finalizar a constru��o do cache
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function end();

    /**
     * M�todo respons�vel por adicionar rotas ao cache
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function addRoute($method, $path, $target);

    /**
     * M�todo respons�vel por carregar cache j� existente
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function load(Router $router);
}