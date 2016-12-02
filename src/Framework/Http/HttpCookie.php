<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

class HttpCookie implements HttpCookieInterface
{
    private $name;
    private $value;
    private $domain;
    private $path;
    private $maxAge;
    private $secure;
    private $httpOnly;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setMaxAge(int $seconds): void
    {
        $this->maxAge = $seconds;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function setSecure(bool $secure): void
    {
        $this->secure = $secure;
    }

    public function setHttpOnly(bool $httpOnly): void
    {
        $this->httpOnly = $httpOnly;
    }

    public function getHeaderString(): string
    {
        $parts = [
            $this->name . '=' . rawurlencode($this->value),
            $this->getMaxAgeString(),
            $this->getExpiresString(),
            $this->getDomainString(),
            $this->getPathString(),
            $this->getSecureString(),
            $this->getHttpOnlyString(),
        ];

        $filteredParts = array_filter($parts);
        return implode('; ', $filteredParts);
    }

    private function getMaxAgeString(): string
    {
        if ($this->maxAge !== null) {
            return 'Max-Age='. $this->maxAge;
        }

        return '';
    }

    private function getExpiresString(): string
    {
        if ($this->maxAge !== null) {
            return 'expires=' . gmdate(
                "D, d-M-Y H:i:s",
                time() + $this->maxAge
            ) . ' GMT';
        }

        return '';
    }

    private function getDomainString(): string
    {
        if ($this->domain) {
            return "domain=$this->domain";
        }

        return '';
    }

    private function getPathString(): string
    {
        if ($this->path) {
            return "path=$this->path";
        }

        return '';
    }

    private function getSecureString(): string
    {
        if ($this->secure) {
            return 'secure';
        }

        return '';
    }

    private function getHttpOnlyString(): string
    {
        if ($this->httpOnly) {
            return 'HttpOnly';
        }

        return '';
    }
}
