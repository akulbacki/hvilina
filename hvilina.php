<?php
/**
 * Hvilina Rest API Framework
 * Version: 1.0.0
 * Author: Aleksander Kulbacki
 * Github: akulbacki
 * 
 * A minimalistic PHP framework for handling HTTP requests and responses.
 * Provides routing capabilities for general requests.
 */
class Hvilina {

    private $routes = ['GET' => [], 'POST' => [], 'PUT' => [], 'DELETE' => [], 'ALL' => []];
    private $request, $response;

    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function get($route, $callback) {
        $this->routes['GET'][$route] = $callback;
    }

    public function post($route, $callback) {
        $this->routes['POST'][$route] = $callback;
    }

    public function put($route, $callback) {
        $this->routes['PUT'][$route] = $callback;
    }

    public function delete($route, $callback) {
        $this->routes['DELETE'][$route] = $callback;
    }

    public function all($route, $callback) {
        $this->routes['ALL'][$route] = $callback;
    }

    public function route($method, $route, $callback) {
        $this->routes[$method][$route] = $callback;
    }

    public function listen() {
        $route = $this->request->uri;
        $method = $this->request->method;
        $callback = $this->routes[$method][$route] ?? $this->routes['ALL'][$route] ?? null;

        if ($callback) {
            call_user_func($callback, $this->request, $this->response);
            $this->response->send();
        } else {
            echo "404 Not Found";
        }
    }
}

class Request {
    public $method, $uri, $queryParams, $body;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->queryParams = $_GET;
        $this->body = file_get_contents('php://input');
    }
}

class Response {
    private $headers = [], $body;

    public function header($name, $value) {
        $this->headers[$name] = $value;
    }

    public function renderJSON($content) {
      $this->body = $content;
    }

    public function renderHTML($content) {
        $this->body = $content;
    }

    public function renderView($template, $params = []) {
        extract($params);
        ob_start();
        if (file_exists($template)) {
            include $template;
        } else {
            die("Wrong template path");
        }
        $this->body = ob_get_clean();
    }

    public function send() {
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->body;
    }
}