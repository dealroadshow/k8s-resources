<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * A scoped-resource selector requirement is a selector that contains values, a
 * scope name, and an operator that relates the scope name and values.
 */
class ScopedResourceSelectorRequirement implements JsonSerializable
{
    /**
     * Represents a scope's relationship to a set of values. Valid operators are In,
     * NotIn, Exists, DoesNotExist.
     *
     * Possible enum values:
     *  - `"DoesNotExist"`
     *  - `"Exists"`
     *  - `"In"`
     *  - `"NotIn"`
     */
    private string $operator;

    /**
     * The name of the scope that the selector applies to.
     *
     * Possible enum values:
     *  - `"BestEffort"` Match all pod objects that have best effort quality of service
     *  - `"CrossNamespacePodAffinity"` Match all pod objects that have cross-namespace
     * pod (anti)affinity mentioned. This is a beta feature enabled by the
     * PodAffinityNamespaceSelector feature flag.
     *  - `"NotBestEffort"` Match all pod objects that do not have best effort quality
     * of service
     *  - `"NotTerminating"` Match all pod objects where spec.activeDeadlineSeconds is
     * nil
     *  - `"PriorityClass"` Match all pod objects that have priority class mentioned
     *  - `"Terminating"` Match all pod objects where spec.activeDeadlineSeconds >=0
     */
    private string $scopeName;

    /**
     * An array of string values. If the operator is In or NotIn, the values array must
     * be non-empty. If the operator is Exists or DoesNotExist, the values array must
     * be empty. This array is replaced during a strategic merge patch.
     */
    private StringList $values;

    public function __construct(string $operator, string $scopeName)
    {
        $this->operator = $operator;
        $this->scopeName = $scopeName;
        $this->values = new StringList();
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getScopeName(): string
    {
        return $this->scopeName;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function setScopeName(string $scopeName): self
    {
        $this->scopeName = $scopeName;

        return $this;
    }

    public function values(): StringList
    {
        return $this->values;
    }

    public function jsonSerialize(): array
    {
        return [
            'operator' => $this->operator,
            'scopeName' => $this->scopeName,
            'values' => $this->values,
        ];
    }
}
