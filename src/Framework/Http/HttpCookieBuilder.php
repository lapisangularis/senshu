<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

class CookieBuilder
{
    private $defaultDomain;
    private $defaultPath = '/';
    private $defaultSecure = true;
    private $defaultHttpOnly = true;

    public function setDefaultDomain(string $domain): self
    {
        $this->defaultDomain = $domain;

        return $this;
    }
    public function setDefaultPath(string $path): self
    {
        $this->defaultPath = $path;

        return $this;
    }
    public function setDefaultSecure(bool $secure): self
    {
        $this->defaultSecure = $secure;

        return $this;
    }
    public function setDefaultHttpOnly(bool $httpOnly): self
    {
        $this->defaultHttpOnly = $httpOnly;

        return $this;
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