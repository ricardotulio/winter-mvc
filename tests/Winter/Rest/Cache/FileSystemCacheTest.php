<?php
namespace Winter\Rest\Cache;

use PHPUnit\Framework\TestCase;
use Winter\Rest\Cache\FileSystemCache;
class FileSystemCacheTest extends TestCase
{
    
    private $fileContents = <<<EOF
<?php
            
namespace Winter\Rest\Cache\__CACHE__;
    
use Winter\Rest\Router\Router;

class FileSystemCache {
    
    public function load(Router \$router) 
    {
EOF;
    
    protected $cache;
    
    protected function setUp(){
        $this->cache = new FileSystemCache("tmp/");
    }

    public function testValidaSeExisteAlgumCache()
    {
        $this->assertTrue($this->cache->hasCache());
    }
    
}   