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

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setMaxAge(int $seconds): self
    {
        $this->maxAge = $seconds;

        return $this;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setSecure(bool $secure): self
    {
        $this->secure = $secure;

        return $this;
    }

    public function setHttpOnly(bool $httpOnly): self
    {
        $this->httpOnly = $httpOnly;

        return $this;
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
