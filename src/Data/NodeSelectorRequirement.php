<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * A node selector requirement is a selector that contains values, a key, and an
 * operator that relates the key and values.
 */
class NodeSelectorRequirement implements JsonSerializable
{
    /**
     * The label key that the selector applies to.
     */
    private string $key;

    /**
     * Represents a key's relationship to a set of values. Valid operators are In,
     * NotIn, Exists, DoesNotExist. Gt, and Lt.
     */
    private string $operator;

    /**
     * An array of string values. If the operator is In or NotIn, the values array must
     * be non-empty. If the operator is Exists or DoesNotExist, the values array must
     * be empty. If the operator is Gt or Lt, the values array must have a single
     * element, which will be interpreted as an integer. This array is replaced during
     * a strategic merge patch.
     */
    private StringList $values;

    public function __construct(string $key, string $operator)
    {
        $this->key = $key;
        $this->operator = $operator;
        $this->values = new StringList();
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function values(): StringList
    {
        return $this->values;
    }

    public function jsonSerialize(): array
    {
        return [
            'key' => $this->key,
            'operator' => $this->operator,
            'values' => $this->values,
        ];
    }
}
