<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Router;

class Route
{
    private $method;
    private $regex;
    private $variables;
    private $arguments;
    private $handler;

    public function __construct(string $method, callable $handler, string $regex, array $variables)
    {
        $this->method = $method;
        $this->handler = $handler;
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
        $callback = call_user_func_array($this->handler, $this->arguments);

        return $callback;
    }
}