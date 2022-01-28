<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SelfSubjectRulesReviewSpec defines the specification for SelfSubjectRulesReview.
 */
class SelfSubjectRulesReviewSpec implements JsonSerializable
{
    /**
     * Namespace to evaluate rules for. Required.
     */
    private string|null $namespace = null;

    public function __construct()
    {
    }

    public function getNamespace(): string|null
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'namespace' => $this->namespace,
        ];
    }
}
