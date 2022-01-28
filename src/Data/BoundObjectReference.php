<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * BoundObjectReference is a reference to an object that a token is bound to.
 */
class BoundObjectReference implements JsonSerializable
{
    /**
     * API version of the referent.
     */
    private string|null $apiVersion = null;

    /**
     * Kind of the referent. Valid kinds are 'Pod' and 'Secret'.
     */
    private string|null $kind = null;

    /**
     * Name of the referent.
     */
    private string|null $name = null;

    /**
     * UID of the referent.
     */
    private string|null $uid = null;

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

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getUid(): string|null
    {
        return $this->uid;
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'name' => $this->name,
            'uid' => $this->uid,
        ];
    }
}
