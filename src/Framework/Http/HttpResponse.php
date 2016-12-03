<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Http;

class HttpResponse implements HttpResponseInterface
{
    private $version = '1.1';
    private $statusCode = 200;
    private $headers = [];
    private $cookies = [];
    private $content = '';

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function getHeaders(): array
    {
        $headers = array_merge(
            $this->getRequestLineHeaders(),
            $this->getStandardHeaders(),
            $this->getCookieHeaders()
        );
        return $headers;
    }

    public function addHeader(string $name, string $value): void
    {
        $this->headers[$name][] = $value;
    }

    public function setHeader(string $name, string $value): void
    {
        $this->headers[$name] = [
            $value,
        ];
    }

    public function sendAllHttpHeaders(): void
    {
        foreach ($this->getHeaders() as $header) {
            header($header, false);
        }
    }

    public function addCookie(HttpCookie $cookie): void
    {
        $this->cookies[$cookie->getName()] = $cookie;
    }

    public function deleteCookie(HttpCookie $cookie): void
    {
        $cookie->setValue('');
        $cookie->setMaxAge(-1);
        $this->cookies[$cookie->getName()] = $cookie;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function redirect(string $url): void
    {
        $this->setHeader('Location', $url);
        $this->setStatusCode(301);
    }

    private function getRequestLineHeaders(): array
    {
        $headers = [];

        $requestLine = sprintf(
            'HTTP/%s %s',
            $this->version,
            $this->statusCode
        );

        $headers[] = trim($requestLine);
        return $headers;
    }
    private function getStandardHeaders(): array
    {
        $headers = [];

        foreach ($this->headers as $name => $values) {
            foreach ($values as $value) {
                $headers[] = "$name: $value";
            }
        }

        return $headers;
    }

    private function getCookieHeaders(): array
    {
        $headers = [];

        foreach ($this->cookies as $cookie) {
            $headers[] = 'Set-Cookie: ' . $cookie->getHeaderString();
        }

        return $headers;
    }
}
