<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * TCPSocketAction describes an action based on opening a socket
 */
class TCPSocketAction implements JsonSerializable
{
    /**
     * Optional: Host name to connect to, defaults to the pod IP.
     */
    private string|null $host = null;

    /**
     * Number or name of the port to access on the container. Number must be in the
     * range 1 to 65535. Name must be an IANA_SVC_NAME.
     */
    private string|int $port;

    public function __construct(string|int $port)
    {
        $this->port = $port;
    }

    public function getHost(): string|null
    {
        return $this->host;
    }

    public function getPort(): string|int
    {
        return $this->port;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function setPort(string|int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'host' => $this->host,
            'port' => $this->port,
        ];
    }
}
