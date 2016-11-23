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

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
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

    public function addHeader(string $name, string $value): self
    {
        $this->headers[$name][] = $value;

        return $this;
    }

    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = [
            $value,
        ];

        return $this;
    }

    public function addCookie(HttpCookie $cookie): self
    {
        $this->cookies[$cookie->getName()] = $cookie;

        return $this;
    }

    public function deleteCookie(HttpCookie $cookie): self
    {
        $cookie->setValue('');
        $cookie->setMaxAge(-1);
        $this->cookies[$cookie->getName()] = $cookie;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function redirect(string $url): self
    {
        $this->setHeader('Location', $url);
        $this->setStatusCode(301);

        return $this;
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