<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

interface HttpCookieInterface
{
    public function getName(): string;
    public function setValue(string $value);
    public function setMaxAge(int $seconds);
    public function setDomain(string $domain);
    public function setPath(string $path);
    public function setSecure(bool $secure);
    public function setHttpOnly(bool $httpOnly);
    public function getHeaderString(): string;
}
