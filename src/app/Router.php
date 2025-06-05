<?php

declare(strict_types=1);

namespace App;

use App\Exception\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $route, callable|array $action): self
    {
        $this->routes[$route] = $action;
        
        return $this;
    }

    public function resolve(string $requestUri)
    {        
        $route = explode('?', $requestUri)[0]; // Remove query string if present
        $action = $this->routes[$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException();
        }

        if(is_callable($action)) {
            return call_user_func($action);
        }

        if(is_array($action)) {
            
            // !!! Array destructuring !!!
            [$class, $method] = $action;

            if(class_exists($class)) {
                $class = new $class();

                if(method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();

        //return call_user_func($action);

    }

}
