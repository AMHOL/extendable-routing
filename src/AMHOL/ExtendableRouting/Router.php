<?php namespace AMHOL\ExtendableRouting;

use Symfony\Component\Debug\Exception\FatalErrorException;
use Illuminate\Routing\Router as LaravelRouter;

class Router extends LaravelRouter
{
    /**
     * Array containing (callable) extensions
     * 
     * @var array
     */
    protected $extensions = [];

    /**
     * Extend the router with a custom method
     * 
     * @param  string   $method   The name of the method to add
     * @param  callable $callback The callback containing the extension method body
     * @return AMHOL\ExtendableRouting\Router $this
     */
    public function extend($method, callable $callback)
    {
        $this->extensions[$method] = $callback;
        return $this;
    }

    public function __call($method, $arguments)
    {
        if ( isset($this->extensions[$method]) ) {
            return call_user_func_array($this->extensions[$method], $arguments);
        } else {
            throw new FatalErrorException('Call to undefined method '. __CLASS__ .'::'. $method .'()', 1, 0, __FILE__, __LINE__);
        }
    }

}
