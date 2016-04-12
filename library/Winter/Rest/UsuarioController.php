<?php
namespace Winter\Rest;

use Respect\Rest\Routable;
use Winter\Rest\Annotations\Path;

class_exists('Winter\Rest\Annotations\Path');

/**
 * @Path("/usuario/v1")
 */
class UsuarioController implements Routable
{

    public function get()
    {
        return "Hello, world!";
    }
}