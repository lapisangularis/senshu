<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

interface HttpResponseInterface
{
    public function getStatusCode(): int;
    public function setStatusCode(int $statusCode);
    public function getHeaders(): array;
    public function addHeader(string $name, string $value);
    public function setHeader(string $name, string $value);
    public function addCookie(HttpCookie $cookie);
    public function deleteCookie(HttpCookie $cookie);
    public function getContent(): string;
    public function setContent(string $content);
    public function redirect(string $url);
}