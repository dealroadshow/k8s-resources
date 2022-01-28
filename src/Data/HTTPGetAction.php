<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\HTTPHeaderList;
use JsonSerializable;

/**
 * HTTPGetAction describes an action based on HTTP Get requests.
 */
class HTTPGetAction implements JsonSerializable
{
    /**
     * Host name to connect to, defaults to the pod IP. You probably want to set "Host"
     * in httpHeaders instead.
     */
    private string|null $host = null;

    /**
     * Custom headers to set in the request. HTTP allows repeated headers.
     */
    private HTTPHeaderList $httpHeaders;

    /**
     * Path to access on the HTTP server.
     */
    private string|null $path = null;

    /**
     * Name or number of the port to access on the container. Number must be in the
     * range 1 to 65535. Name must be an IANA_SVC_NAME.
     */
    private string|int $port;

    /**
     * Scheme to use for connecting to the host. Defaults to HTTP.
     *
     * Possible enum values:
     *  - `"HTTP"` means that the scheme used will be http://
     *  - `"HTTPS"` means that the scheme used will be https://
     */
    private string|null $scheme = null;

    public function __construct(string|int $port)
    {
        $this->httpHeaders = new HTTPHeaderList();
        $this->port = $port;
    }

    public function getHost(): string|null
    {
        return $this->host;
    }

    public function getPath(): string|null
    {
        return $this->path;
    }

    public function getPort(): string|int
    {
        return $this->port;
    }

    public function getScheme(): string|null
    {
        return $this->scheme;
    }

    public function httpHeaders(): HTTPHeaderList
    {
        return $this->httpHeaders;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setPort(string|int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'host' => $this->host,
            'httpHeaders' => $this->httpHeaders,
            'path' => $this->path,
            'port' => $this->port,
            'scheme' => $this->scheme,
        ];
    }
}
