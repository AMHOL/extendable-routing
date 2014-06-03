<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use AMHOL\ExtendableRouting\Router;

class RoutingRouteTest extends PHPUnit_Framework_TestCase {

    public function testExtendingOfRoutes()
    {
        $router = $this->getRouter();
        $router->extend('myCustomRouteExtension', function($url) use ($router) {
            $router->get($url, function() {
                return 'It works!';
            });
        });
        $router->myCustomRouteExtension('foo/bar');
        $this->assertEquals('It works!', $router->dispatch(Request::create('foo/bar', 'GET'))->getContent());
    }

    protected function getRouter()
    {
        return new Router(new Illuminate\Events\Dispatcher);
    }
}