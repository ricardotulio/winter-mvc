<?php
namespace Winter\Mvc;

use Respect\Rest\Routable;
use Winter\Mvc\Annotations\Controller;

/**
 * @Controller
 * @RequestMapping("/usuario/v1")
 * 
 * @author Ricardo
 *        
 */
class UsuarioController implements Routable
{

    public function get()
    {
        return "Jajajaja";
    }
}