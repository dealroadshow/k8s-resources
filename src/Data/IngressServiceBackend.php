<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * IngressServiceBackend references a Kubernetes Service as a Backend.
 */
class IngressServiceBackend implements JsonSerializable
{
    /**
     * Name is the referenced service. The service must exist in the same namespace as
     * the Ingress object.
     */
    private string $name;

    /**
     * Port of the referenced service. A port name or port number is required for a
     * IngressServiceBackend.
     */
    private ServiceBackendPort $port;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->port = new ServiceBackendPort();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function port(): ServiceBackendPort
    {
        return $this->port;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'port' => $this->port,
        ];
    }
}
