<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

interface HttpRequestInterface
{
    public function getParameter(string $key): mixed;
    public function getParameters(): array;
    public function getGetParameter(string $key): mixed;
    public function getGetParameters(): array;
    public function getPostParameter(string $key): mixed;
    public function getPostParameters(): array;
    public function getInput(): string;
    public function getCookie(string $key): mixed;
    public function getCookies(): array;
    public function getServerVariable(string $key): string;
    public function getUri(): string;
    public function getUriPath(): string;
    public function getMethod(): string;
    public function getHttpAccept(): string;
    public function getReferer(): string;
    public function getUserAgent(): string;
    public function getIpAddress(): string;
    public function isSSL(): bool;
    public function getQueryString(): string;
}
