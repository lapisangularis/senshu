<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Router;

class RouteCollection
{
    private $routes = [];

    public function addRoute(string $httpMethod, string $route, callable $handler): self
    {
        $regex = Parser::parsePathToRegex($route);
        $variables = Parser::parsePathArguments($route);

        $collectionItem = new Route($httpMethod, $handler, $regex, $variables);
        $this->routes[] = $collectionItem;

        return $this;
    }

    public function get(string $route, callable $handler): self
    {
        $this->addRoute('GET', $route, $handler);

        return $this;
    }

    public function post(string $route, callable $handler): self
    {
        $this->addRoute('POST', $route, $handler);

        return $this;
    }

    public function put(string $route, callable $handler): self
    {
        $this->addRoute('PUT', $route, $handler);

        return $this;
    }

    public function delete(string $route, callable $handler): self
    {
        $this->addRoute('DELETE', $route, $handler);

        return $this;
    }

    public function patch(string $route, callable $handler): self
    {
        $this->addRoute('PATCH', $route, $handler);

        return $this;
    }

    public function head(string $route, callable $handler): self
    {
        $this->addRoute('HEAD', $route, $handler);

        return $this;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}