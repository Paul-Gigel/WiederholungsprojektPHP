<?php

namespace core;

use core\Response;
use core\Request;
class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [

    ];

    public function __construct(Request $request, Response $response)   {
        $this->request = $request;
        $this->response = $response;
    }

    public function resolve()   {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false)    {
            $this->response->setStatuscode("404");
        }
        if(is_string($callback))    {

        }
    }
}