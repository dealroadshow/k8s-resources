<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodOS defines the OS parameters of a pod.
 */
class PodOS implements JsonSerializable
{
    /**
     * Name is the name of the operating system. The currently supported values are
     * linux and windows. Additional value may be defined in future and can be one of:
     * https://github.com/opencontainers/runtime-spec/blob/master/config.md#platform-specific-configuration
     * Clients should expect to handle additional values and treat unrecognized values
     * in this field as os: null
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
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
        ];
    }
}
