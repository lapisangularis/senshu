<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Router;

class RouteCollection
{
    private $routes = [];

    public function addRoute(string $httpMethod, string $route, string $controller, string $action, array $config): void
    {
        $regex = Parser::parsePathToRegex($route);
        $variables = Parser::parsePathArguments($route);
        $fullPath = $config['classBasePath'] . '\\' . $controller;
        $collectionItem = new Route($httpMethod, $fullPath, $action, $regex, $route, $variables, $config);
        $this->routes[$controller . '::' . $action] = $collectionItem;
    }

    public function get(string $route, string $controller, string $action, array $config): void
    {
        $this->addRoute('GET', $route, $controller, $action, $config);
    }

    public function post(string $route, string $controller, string $action, array $config): void
    {
        $this->addRoute('POST', $route, $controller, $action, $config);
    }

    public function put(string $route, string $controller, string $action, array $config): void
    {
        $this->addRoute('PUT', $route, $controller, $action, $config);
    }

    public function delete(string $route, string $controller, string $action, array $config): void
    {
        $this->addRoute('DELETE', $route, $controller, $action, $config);
    }

    public function patch(string $route, string $controller, string $action, array $config): void
    {
        $this->addRoute('PATCH', $route, $controller, $action, $config);
    }

    public function head(string $route, string $controller, string $action, array $config): void
    {
        $this->addRoute('HEAD', $route, $controller, $action, $config);
    }

    public function getRoutes(): iterable
    {
        return $this->routes;
    }
}
