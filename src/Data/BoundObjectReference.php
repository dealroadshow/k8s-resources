<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * BoundObjectReference is a reference to an object that a token is bound to.
 */
class BoundObjectReference implements JsonSerializable
{
    /**
     * API version of the referent.
     *
     * @var string|null
     */
    private ?string $apiVersion = null;

    /**
     * Kind of the referent. Valid kinds are 'Pod' and 'Secret'.
     *
     * @var string|null
     */
    private ?string $kind = null;

    /**
     * Name of the referent.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * UID of the referent.
     *
     * @var string|null
     */
    private ?string $uid = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    /**
     * @return string|null
     */
    public function getKind(): ?string
    {
        return $this->kind;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
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

    public function jsonSerialize()
    {
        return [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'name' => $this->name,
            'uid' => $this->uid,
        ];
    }
}
