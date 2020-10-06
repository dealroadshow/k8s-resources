<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\HTTPHeaderList;
use Dealroadshow\K8S\ValueObject\IntOrString;
use JsonSerializable;

/**
 * HTTPGetAction describes an action based on HTTP Get requests.
 */
class HTTPGetAction implements JsonSerializable
{
    /**
     * Host name to connect to, defaults to the pod IP. You probably want to set "Host"
     * in httpHeaders instead.
     *
     * @var string|null
     */
    private ?string $host = null;

    /**
     * Custom headers to set in the request. HTTP allows repeated headers.
     */
    private HTTPHeaderList $httpHeaders;

    /**
     * Path to access on the HTTP server.
     *
     * @var string|null
     */
    private ?string $path = null;

    /**
     * Name or number of the port to access on the container. Number must be in the
     * range 1 to 65535. Name must be an IANA_SVC_NAME.
     */
    private IntOrString $port;

    /**
     * Scheme to use for connecting to the host. Defaults to HTTP.
     *
     * @var string|null
     */
    private ?string $scheme = null;

    public function __construct(IntOrString $port)
    {
        $this->httpHeaders = new HTTPHeaderList();
        $this->port = $port;
    }

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    public function getPort(): IntOrString
    {
        return $this->port;
    }

    /**
     * @return string|null
     */
    public function getScheme(): ?string
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

    public function setPort(IntOrString $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function jsonSerialize()
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
