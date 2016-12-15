<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Router;

class Route
{
    protected $method;
    protected $regex;
    protected $variables;
    protected $arguments;
    protected $controller;
    protected $action;
    protected $callback;
    protected $config;
    protected $originalPath;

    public function __construct(
        string $method,
        string $controller,
        string $action,
        string $regex,
        string $originalPath,
        array $variables,
        array $config
    )
    {
        $this->method = $method;
        $this->controller = $controller;
        $this->action = $action;
        $this->regex = $regex;
        $this->variables = $variables;
        $this->config = $config;
        $this->originalPath = $originalPath;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRegex(): string
    {
        return $this->regex;
    }

    public function getOriginalPath(): string
    {
        return $this->originalPath;
    }

    public function getVariables(): ?array
    {
        return $this->variables;
    }

    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function matches(string $str): bool
    {
        $regex = '/^' . $this->regex . '$/';

        return (bool) preg_match($regex, $str);
    }

    public function dispatch(): void
    {
        $config = $this->config;
        $callback = [$this->controller, $this->action];
        $this->callback = !empty($callback[1]) && trim($callback[1]) !== '' ? $callback[1] : null;

        $instance = isset($config['dependencyManager']) ? new $callback[0]($config['dependencyManager']) : new $callback[0];
        call_user_func_array([$instance, $this->action], $this->arguments);
    }
}
