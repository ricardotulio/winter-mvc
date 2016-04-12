<?php
namespace Winter\Rest;

use Winter\Rest\Annotations\Path;

class_exists('Winter\Rest\Annotations\Path');

/**
 * @Path("/perfil/v1")
 */
class PerfilController
{

    public function get()
    {
        return "Hello, world!";
    }
}