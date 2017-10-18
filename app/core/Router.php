<?php

namespace core;

/**
 * Class Router
 * @package core
 */
class Router
{
    private $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @return array
     */
    private function urlParsing()
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        return [
            'controller' => explode('/', $uri)[1] ?? null,
            'action' => explode('/', $uri)[2] ?? null,
            'params' => $_POST,
        ];
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function callAction()
    {
        $url = $this->urlParsing();
        $name = ucfirst($url['controller']);
        $controller = $this->namespace . '\\' . $name . 'Controller';
        if (!class_exists($controller)) {
            throw new \Exception('Controller not found');
        }
        $controller = new $controller();
        return $controller->{lcfirst($url['action']) . 'Action'}($url['params']);
    }
}