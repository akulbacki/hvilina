<?php
/**
 * Hvilina Rest API Framework
 * Version: 1.2.0
 * Author: Alexey Kulbacki
 * Github: akulbacki
 * 
 * A minimalistic framework for handling HTTP requests and responses.
 * Provides routing capabilities for general requests.
 */

namespace Hvilina;

class Hvilina {

    private $router;
    public $request, $response;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
    }

    public function get($route, $callback)
    {
        $this->router->add('GET', $route, $callback);
    }

    public function post($route, $callback)
    {
        $this->router->add('POST', $route, $callback);
    }

    public function put($route, $callback)
    {
        $this->router->add('PUT', $route, $callback);
    }

    public function delete($route, $callback)
    {
        $this->router->add('DELETE', $route, $callback);
    }

    public function request($method, $route, $callback)
    {
        $this->router->add($method, $route, $callback);
    }

    public function listen()
    {
        $handler = $this->router->dispatch($this->request);
        if( $handler ) 
        {
            $handler($this->request, $this->response);
            $this->response->send();
        } else {
            $this->response->notFound();
        } 
    }
}

class Request {
    public $method, $uri, $queryParams, $body, $params;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->queryParams = $_GET;
        $this->body = file_get_contents('php://input');
    }
}

class Response {
    private $headers, $body, $statusCode = 200;

    public function header($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function status($code)
    {
        $this->statusCode = $code;
    }

    public function notFound()
    {
        $this->status(404)->send('404 Not Found');
    }

    public function renderText($content)
    {
        $this->body = $content;
    }

    public function renderView($template, $params = [])
    {
        extract($params);
        ob_start();
        if (file_exists($template)) {
            include $template;
        } else {
            die("Wrong template path");
        }
        $this->body = ob_get_clean();
    }

    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value)
        {
            header("$name: $value");
        }
        echo $this->body;
    }
}

class Router {
    private $routes;
    
    public function add($method, $route, $handler)
    {
        $this->routes[$method][$this->compileRoute($route)] = $handler;
    }
    
    private function compileRoute($route)
    {
        return preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route);
    }
    
    public function dispatch($request)
    {
        foreach ($this->routes[$request->method] ?? [] as $pattern => $handler)
        {
            if (preg_match("#^$pattern$#", $request->uri, $matches)) {
                $request->params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return $handler;
            }
        }
        return null;
    }
}
