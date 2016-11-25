<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Router;

class Route
{
    private $method;
    private $regex;
    private $variables;
    private $arguments;
    private $controller;
    private $action;
    private $callback;

    public function __construct(string $method, string $controller, string $action, string $regex, array $variables)
    {
        $this->method = $method;
        $this->controller = $controller;
        $this->action = $action;
        $this->regex = $regex;
        $this->variables = $variables;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRegex(): string
    {
        return $this->regex;
    }

    public function setArguments(array $arguments): self
    {
        $this->arguments = $arguments;

        return $this;
    }

    public function matches(string $str): bool
    {
        $regex = '/^' . $this->regex . '$/';

        return (bool) preg_match($regex, $str);
    }

    public function dispatch()
    {
        $callback = [$this->controller, $this->action];
        $this->callback = !empty($callback[1]) && trim($callback[1]) !== '' ? $callback[1] : null;

        if (!is_null($this->callback)) {
            $instance = new $callback[0];
            call_user_func_array([$instance, $this->action], $this->arguments);
        } else {
            $instance = new $callback[0]($this->arguments);
        }

        return $instance;
    }
}