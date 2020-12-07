<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * IngressBackend describes all endpoints for a given service and port.
 */
class IngressBackend implements JsonSerializable
{
    /**
     * Specifies the name of the referenced service.
     */
    private string $serviceName;

    /**
     * Specifies the port of the referenced service.
     */
    private string|int $servicePort;

    public function __construct(string $serviceName, string|int $servicePort)
    {
        $this->serviceName = $serviceName;
        $this->servicePort = $servicePort;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function getServicePort(): string|int
    {
        return $this->servicePort;
    }

    public function setServiceName(string $serviceName): self
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    public function setServicePort(string|int $servicePort): self
    {
        $this->servicePort = $servicePort;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'serviceName' => $this->serviceName,
            'servicePort' => $this->servicePort,
        ];
    }
}
