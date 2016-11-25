<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Router;

class RouteCollection
{
    private $routes = [];

    public function addRoute(string $httpMethod, string $route, string $controller, string $action, array $config): self
    {
        $regex = Parser::parsePathToRegex($route);
        $variables = Parser::parsePathArguments($route);
        $fullPath = $config['classBasePath'] . $controller;
        $collectionItem = new Route($httpMethod, $fullPath, $action, $regex, $variables);
        $this->routes[] = $collectionItem;

        return $this;
    }

    public function get(string $route, string $controller, string $action, array $config): self
    {
        $this->addRoute('GET', $route, $controller, $action, $config);
        return $this;
    }

    public function post(string $route, string $controller, string $action, array $config): self
    {
        $this->addRoute('POST', $route, $controller, $action, $config);
        return $this;
    }

    public function put(string $route, string $controller, string $action, array $config): self
    {
        $this->addRoute('PUT', $route, $controller, $action, $config);
        return $this;
    }

    public function delete(string $route, string $controller, string $action, array $config): self
    {
        $this->addRoute('DELETE', $route, $controller, $action, $config);
        return $this;
    }

    public function patch(string $route, string $controller, string $action, array $config): self
    {
        $this->addRoute('PATCH', $route, $controller, $action, $config);
        return $this;
    }

    public function head(string $route, string $controller, string $action, array $config): self
    {
        $this->addRoute('HEAD', $route, $controller, $action, $config);
        return $this;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}