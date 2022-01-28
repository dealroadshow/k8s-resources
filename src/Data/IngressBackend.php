<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * IngressBackend describes all endpoints for a given service and port.
 */
class IngressBackend implements JsonSerializable
{
    /**
     * Resource is an ObjectRef to another Kubernetes resource in the namespace of the
     * Ingress object. If resource is specified, a service.Name and service.Port must
     * not be specified. This is a mutually exclusive setting with "Service".
     */
    private TypedLocalObjectReference|null $resource = null;

    /**
     * Service references a Service as a Backend. This is a mutually exclusive setting
     * with "Resource".
     */
    private IngressServiceBackend|null $service = null;

    public function __construct()
    {
    }

    public function getResource(): TypedLocalObjectReference|null
    {
        return $this->resource;
    }

    public function getService(): IngressServiceBackend|null
    {
        return $this->service;
    }

    public function setResource(TypedLocalObjectReference $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function setService(IngressServiceBackend $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'resource' => $this->resource,
            'service' => $this->service,
        ];
    }
}
