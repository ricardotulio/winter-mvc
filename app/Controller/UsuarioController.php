<?php
namespace MyApp\Controller;

use Respect\Rest\Routable;
use Winter\Rest\Annotations\Path;

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