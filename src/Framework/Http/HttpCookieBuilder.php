<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

class CookieBuilder
{
    private $defaultDomain;
    private $defaultPath = '/';
    private $defaultSecure = true;
    private $defaultHttpOnly = true;

    public function setDefaultDomain(string $domain): void
    {
        $this->defaultDomain = $domain;
    }

    public function setDefaultPath(string $path): void
    {
        $this->defaultPath = $path;
    }

    public function setDefaultSecure(bool $secure): void
    {
        $this->defaultSecure = $secure;
    }

    public function setDefaultHttpOnly(bool $httpOnly): void
    {
        $this->defaultHttpOnly = $httpOnly;
    }

    public function build(string $name, string $value): HttpCookie
    {
        $cookie = new HttpCookie($name, $value);
        $cookie->setPath($this->defaultPath);
        $cookie->setSecure($this->defaultSecure);
        $cookie->setHttpOnly($this->defaultHttpOnly);

        if ($this->defaultDomain !== null) {
            $cookie->setDomain($this->defaultDomain);
        }

        return $cookie;
    }
}
