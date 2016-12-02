<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

class HttpRequest implements HttpRequestInterface
{
    protected $getParameters;
    protected $postParameters;
    protected $server;
    protected $cookies;
    protected $input;

    public function __construct(
        array $get,
        array $post,
        iterable $cookies,
        array $server,
        string $input = ''
    ) {
        $this->getParameters = $get;
        $this->postParameters = $post;
        $this->cookies = $cookies;
        $this->server = $server;
        $this->input = $input;
    }

    public function getParameter(string $key): ?string
    {
        if (array_key_exists($key, $this->postParameters)) {
            return $this->postParameters[$key];
        }
        if (array_key_exists($key, $this->getParameters)) {
            return $this->getParameters[$key];
        }
        return null;
    }

    public function getParameters(): array
    {
        return array_merge($this->getParameters, $this->postParameters);
    }

    public function getGetParameter(string $key): ?string
    {
        if (array_key_exists($key, $this->getParameters)) {
            return $this->getParameters[$key];
        }
        return null;
    }

    public function getGetParameters(): array
    {
        return $this->getParameters;
    }

    public function getPostParameter(string $key): ?string
    {
        if (array_key_exists($key, $this->postParameters)) {
            return $this->postParameters[$key];
        }
        return null;
    }

    public function getPostParameters(): array
    {
        return $this->postParameters;
    }

    public function getCookie(string $key): ?HttpCookie
    {
        if (array_key_exists($key, $this->cookies)) {
            return $this->cookies[$key];
        }
        return null;
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function getCookies(): iterable
    {
        return $this->cookies;
    }

    public function getServerVariable(string $key): string
    {
        return $this->server[$key];
    }

    public function getUri(): string
    {
        return $this->getServerVariable('REQUEST_URI');
    }

    public function getUriPath(): string
    {
        return strtok($this->getServerVariable('REQUEST_URI'), '?');
    }

    public function getMethod(): string
    {
        return $this->getServerVariable('REQUEST_METHOD');
    }

    public function getHttpAccept(): string
    {
        return $this->getServerVariable('HTTP_ACCEPT');
    }

    public function getReferer(): string
    {
        return $this->getServerVariable('HTTP_REFERER');
    }

    public function getUserAgent(): string
    {
        return $this->getServerVariable('HTTP_USER_AGENT');
    }

    public function getIpAddress(): string
    {
        return $this->getServerVariable('REMOTE_ADDR');
    }

    public function isSSL(): bool
    {
        return array_key_exists('HTTPS', $this->server) && $this->server['HTTPS'] !== 'off';
    }

    public function getQueryString(): string
    {
        return $this->getServerVariable('QUERY_STRING');
    }
}
