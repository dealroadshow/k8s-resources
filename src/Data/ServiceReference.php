<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ServiceReference holds a reference to Service.legacy.k8s.io
 */
class ServiceReference implements JsonSerializable
{
    /**
     * `name` is the name of the service. Required
     */
    private string $name;

    /**
     * `namespace` is the namespace of the service. Required
     */
    private string $namespace;

    /**
     * `path` is an optional URL path which will be sent in any request to this
     * service.
     *
     * @var string|null
     */
    private ?string $path = null;

    /**
     * If specified, the port on the service that hosting webhook. Default to 443 for
     * backward compatibility. `port` should be a valid port number (1-65535,
     * inclusive).
     *
     * @var int|null
     */
    private ?int $port = null;

    public function __construct(string $name, string $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'namespace' => $this->namespace,
            'path' => $this->path,
            'port' => $this->port,
        ];
    }
}
