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
use Respect\Rest\Router;
use Winter\Mvc\Annotations\FileReader;

require_once ("vendor/autoload.php");

$annotationReader = new AnnotationReader();
$router = new Router();
$config = array(
    "namespace" => "Winter",
    "path" => "tests\\Winter",
    "cacheDir" => "tmp"
);

$fileReader = new FileReader($annotationReader, $router, $config);
$fileReader->read();
