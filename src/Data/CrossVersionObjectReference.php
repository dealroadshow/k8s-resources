<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * CrossVersionObjectReference contains enough information to let you identify the
 * referred resource.
 */
class CrossVersionObjectReference implements JsonSerializable
{
    /**
     * API version of the referent
     *
     * @var string|null
     */
    private ?string $apiVersion = null;

    /**
     * Kind of the referent; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds"
     */
    private string $kind;

    /**
     * Name of the referent; More info:
     * http://kubernetes.io/docs/user-guide/identifiers#names
     */
    private string $name;

    public function __construct(string $kind, string $name)
    {
        $this->kind = $kind;
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function jsonSerialize()
    {
        return [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'name' => $this->name,
        ];
    }
}
