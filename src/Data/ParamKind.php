<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ParamKind is a tuple of Group Kind and Version.
 */
class ParamKind implements JsonSerializable
{
    /**
     * APIVersion is the API group version the resources belong to. In format of
     * "group/version". Required.
     */
    private string|null $apiVersion = null;

    /**
     * Kind is the API kind the resources belong to. Required.
     */
    private string|null $kind = null;

    public function __construct()
    {
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getKind(): string|null
    {
        return $this->kind;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
        ];
    }
}
