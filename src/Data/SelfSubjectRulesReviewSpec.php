<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

class SelfSubjectRulesReviewSpec implements JsonSerializable
{
    /**
     * Namespace to evaluate rules for. Required.
     *
     * @var string|null
     */
    private ?string $namespace = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'namespace' => $this->namespace,
        ];
    }
}
