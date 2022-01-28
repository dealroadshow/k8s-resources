<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

class GRPCAction implements JsonSerializable
{
    /**
     * Port number of the gRPC service. Number must be in the range 1 to 65535.
     */
    private int $port;

    /**
     * Service is the name of the service to place in the gRPC HealthCheckRequest (see
     * https://github.com/grpc/grpc/blob/master/doc/health-checking.md).
     *
     * If this is not specified, the default behavior is defined by gRPC.
     */
    private string|null $service = null;

    public function __construct(int $port)
    {
        $this->port = $port;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getService(): string|null
    {
        return $this->service;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'port' => $this->port,
            'service' => $this->service,
        ];
    }
}
