<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\IntOrString;
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
    private IntOrString $servicePort;

    public function __construct(string $serviceName, IntOrString $servicePort)
    {
        $this->serviceName = $serviceName;
        $this->servicePort = $servicePort;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function getServicePort(): IntOrString
    {
        return $this->servicePort;
    }

    public function setServiceName(string $serviceName): self
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    public function setServicePort(IntOrString $servicePort): self
    {
        $this->servicePort = $servicePort;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'serviceName' => $this->serviceName,
            'servicePort' => $this->servicePort,
        ];
    }
}
