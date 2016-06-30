<?php
            
namespace Winter\Rest\Cache\__CACHE__;
    
use Winter\Rest\Router\Router;

class FileSystemCache {
    
    public function load(Router $router) 
    {
	$router->any("/usuario/v1", "MyApp\Controller\UsuarioController");
    }
}