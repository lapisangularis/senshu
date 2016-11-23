<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Router;

class Parser
{
    public static function parsePathArguments(string $path): array
    {
        $arguments = [];
        preg_match_all('/\{(\w+)\}/', $path, $matches);

        foreach ($matches[1] as $match) {
            $arguments[] = $match;
        }

        return $arguments;
    }

    public static function parsePathToRegex(string $path): string
    {
        $regex = preg_replace_callback('/\{\w+\}/', function() {
            return '(\w+)';
        }, $path);

        $regex = preg_replace_callback('/\//', function() {
            return '\/';
        }, $regex);

        return $regex;
    }

    public static function parseArgumentData(string $requestPath, Route $route): array
    {
        preg_match_all('/'.$route->getRegex().'/', $requestPath, $matches);
        isset($matches[1]) ? $matches[1] : $matches[1][] = null;
        return $matches[1];
    }
}