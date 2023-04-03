<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ContainerPort represents a network port in a single container.
 */
class ContainerPort implements JsonSerializable
{
    /**
     * Number of port to expose on the pod's IP address. This must be a valid port
     * number, 0 < x < 65536.
     */
    private int $containerPort;

    /**
     * What host IP to bind the external port to.
     */
    private string|null $hostIP = null;

    /**
     * Number of port to expose on the host. If specified, this must be a valid port
     * number, 0 < x < 65536. If HostNetwork is specified, this must match
     * ContainerPort. Most containers do not need this.
     */
    private int|null $hostPort = null;

    /**
     * If specified, this must be an IANA_SVC_NAME and unique within the pod. Each
     * named port in a pod must have a unique name. Name for the port that can be
     * referred to by services.
     */
    private string|null $name = null;

    /**
     * Protocol for port. Must be UDP, TCP, or SCTP. Defaults to "TCP".
     */
    private string|null $protocol = null;

    public function __construct(int $containerPort)
    {
        $this->containerPort = $containerPort;
    }

    public function getContainerPort(): int
    {
        return $this->containerPort;
    }

    public function getHostIP(): string|null
    {
        return $this->hostIP;
    }

    public function getHostPort(): int|null
    {
        return $this->hostPort;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getProtocol(): string|null
    {
        return $this->protocol;
    }

    public function setContainerPort(int $containerPort): self
    {
        $this->containerPort = $containerPort;

        return $this;
    }

    public function setHostIP(string $hostIP): self
    {
        $this->hostIP = $hostIP;

        return $this;
    }

    public function setHostPort(int $hostPort): self
    {
        $this->hostPort = $hostPort;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'containerPort' => $this->containerPort,
            'hostIP' => $this->hostIP,
            'hostPort' => $this->hostPort,
            'name' => $this->name,
            'protocol' => $this->protocol,
        ];
    }
}
