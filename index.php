<?php
define('APPLICATION_PATH', realpath(dirname(__FILE__)));
define('APPLICATION_ENVIRONMENT', 'development');

if (defined('APPLICATION_ENVIRONMENT')) {
    switch (APPLICATION_ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            break;
        case 'testing':
        case 'production':
            error_reporting(0);
            ini_set('display_errors', 0);
            break;
        default:
            exit('The application environment is not set correctly.');
    }
}

use Doctrine\Common\Annotations\AnnotationReader;
use Winter\Rest\Annotations\FileReader;
use Winter\Rest\Cache\FileSystemCache;
use Winter\Rest\Router\RespectRouterAdapter;

require_once ("vendor/autoload.php");


/*  
 * It's create an instance from AnottationReader
*/
$annotationReader = new AnnotationReader();

/*
 * It's created an instance from Router Adapter that you created, or some existing. 
 */
$router = new RespectRouterAdapter();

/*  
 * It's created a instance of our Cache, and you set the folder that you want, by default we use tmp
*/
$cache = new FileSystemCache("tmp/");

/*
 * Here, in the "namespace" is defined the Namespace of directory where you wish sweep
 * In the "Path", you should insert the path that is appointed by namespace
*/
$config = array(
    "namespace" => "MyApp",
    "path" => "app",
    "debug" => false
);

/*  
 * It's here where our application starts, we pass all instances created for it to make the magic
*/
$fileReader = new FileReader($annotationReader, $router, $cache, $config);
$fileReader->read();
