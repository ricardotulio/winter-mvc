<?php
namespace Winter\Rest\Cache;

use Winter\Rest\Router\Router;

/**
 * Interface responsável por prover métodos para manipulação de cache
 * de rotas
 * 
 * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
 * @version 0.1.0
 * @package Winter\Rest\Cache
 */
interface Cache
{

    /**
     * Método responsável por verificar se o cache já foi carregado
     * 
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function hasCache();

    /**
     * Método responsável por iniciar a construção do cache
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function start();
    
    /**
     * Método responsável por finalizar a construção do cache
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function end();

    /**
     * Método responsável por adicionar rotas ao cache
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function addRoute($method, $path, $target);

    /**
     * Método responsável por carregar cache já existente
     *
     * @author Ricardo Ledo de Tulio <ricardo.tulio@fatec.sp.gov.br>
     * @version 0.1.0
     * @return boolean
     */
    public function load(Router $router);
}