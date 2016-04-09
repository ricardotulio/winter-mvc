<?php
namespace Winter\Mvc\Annotations;

use Doctrine\Common\Annotations\Reader;

/**
 * Interface responsável por prover métodos para descoberta de classes
 * que possuam as anotações Winter\Mvc\Annotations\Controller e Winter\Mvc\Annotations\RequestMapping
 *
 * @author Ricardo
 * @package Winter\Mvc\Annotations
 * @version 0.1.0
 */
interface Reader
{

    /**
     * Método responsável por ler as classes que possuem as anotações
     * @Controller e @RequestMapping
     * 
     * @access public
     * @version 0.1.0
     */
    public function read();
}