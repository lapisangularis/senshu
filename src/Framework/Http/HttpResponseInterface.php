<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

interface HttpResponseInterface
{
    public function getStatusCode(): int;
    public function setStatusCode(int $statusCode): void;
    public function getHeaders(): array;
    public function addHeader(string $name, string $value): void;
    public function setHeader(string $name, string $value): void;
    public function addCookie(HttpCookie $cookie): void;
    public function deleteCookie(HttpCookie $cookie): void;
    public function getContent(): string;
    public function setContent(string $content): void;
    public function redirect(string $url): void;
}
