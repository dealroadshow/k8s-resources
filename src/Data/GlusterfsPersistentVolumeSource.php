<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a Glusterfs mount that lasts the lifetime of a pod. Glusterfs volumes
 * do not support ownership management or SELinux relabeling.
 */
class GlusterfsPersistentVolumeSource implements JsonSerializable
{
    /**
     * EndpointsName is the endpoint name that details Glusterfs topology. More info:
     * https://examples.k8s.io/volumes/glusterfs/README.md#create-a-pod
     */
    private string $endpoints;

    /**
     * EndpointsNamespace is the namespace that contains Glusterfs endpoint. If this
     * field is empty, the EndpointNamespace defaults to the same namespace as the
     * bound PVC. More info:
     * https://examples.k8s.io/volumes/glusterfs/README.md#create-a-pod
     */
    private string|null $endpointsNamespace = null;

    /**
     * Path is the Glusterfs volume path. More info:
     * https://examples.k8s.io/volumes/glusterfs/README.md#create-a-pod
     */
    private string $path;

    /**
     * ReadOnly here will force the Glusterfs volume to be mounted with read-only
     * permissions. Defaults to false. More info:
     * https://examples.k8s.io/volumes/glusterfs/README.md#create-a-pod
     */
    private bool|null $readOnly = null;

    public function __construct(string $endpoints, string $path)
    {
        $this->endpoints = $endpoints;
        $this->path = $path;
    }

    public function getEndpoints(): string
    {
        return $this->endpoints;
    }

    public function getEndpointsNamespace(): string|null
    {
        return $this->endpointsNamespace;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function setEndpoints(string $endpoints): self
    {
        $this->endpoints = $endpoints;

        return $this;
    }

    public function setEndpointsNamespace(string $endpointsNamespace): self
    {
        $this->endpointsNamespace = $endpointsNamespace;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'endpoints' => $this->endpoints,
            'endpointsNamespace' => $this->endpointsNamespace,
            'path' => $this->path,
            'readOnly' => $this->readOnly,
        ];
    }
}
