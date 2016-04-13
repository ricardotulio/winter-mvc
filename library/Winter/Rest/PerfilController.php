<?php
namespace Winter\Rest;

use Respect\Rest\Routable;
use Winter\Rest\Annotations\Path;

class_exists('Winter\Rest\Annotations\Path');

/**
 * @Path("/perfil/v1")
 */
class PerfilController implements Routable
{

    public function get()
    {
        return "Carrendo PERFIL Controller!";
    }
}