<?php
namespace Winter\Mvc\Annotations;

use Doctrine\Common\Annotations\Reader;

/**
 * Interface respons�vel por prover m�todos para descoberta de classes
 * que possuam as anota��es Winter\Mvc\Annotations\Controller e Winter\Mvc\Annotations\RequestMapping
 *
 * @author Ricardo
 * @package Winter\Mvc\Annotations
 * @version 0.1.0
 */
interface Reader
{

    /**
     * M�todo respons�vel por ler as classes que possuem as anota��es
     * @Controller e @RequestMapping
     * 
     * @access public
     * @version 0.1.0
     */
    public function read();
}