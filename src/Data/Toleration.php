<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * The pod this Toleration is attached to tolerates any taint that matches the
 * triple <key,value,effect> using the matching operator <operator>.
 */
class Toleration implements JsonSerializable
{
    /**
     * Effect indicates the taint effect to match. Empty means match all taint effects.
     * When specified, allowed values are NoSchedule, PreferNoSchedule and NoExecute.
     */
    private string|null $effect = null;

    /**
     * Key is the taint key that the toleration applies to. Empty means match all taint
     * keys. If the key is empty, operator must be Exists; this combination means to
     * match all values and all keys.
     */
    private string|null $key = null;

    /**
     * Operator represents a key's relationship to the value. Valid operators are
     * Exists and Equal. Defaults to Equal. Exists is equivalent to wildcard for value,
     * so that a pod can tolerate all taints of a particular category.
     */
    private string|null $operator = null;

    /**
     * TolerationSeconds represents the period of time the toleration (which must be of
     * effect NoExecute, otherwise this field is ignored) tolerates the taint. By
     * default, it is not set, which means tolerate the taint forever (do not evict).
     * Zero and negative values will be treated as 0 (evict immediately) by the system.
     */
    private int|null $tolerationSeconds = null;

    /**
     * Value is the taint value the toleration matches to. If the operator is Exists,
     * the value should be empty, otherwise just a regular string.
     */
    private string|null $value = null;

    public function __construct()
    {
    }

    public function getEffect(): string|null
    {
        return $this->effect;
    }

    public function getKey(): string|null
    {
        return $this->key;
    }

    public function getOperator(): string|null
    {
        return $this->operator;
    }

    public function getTolerationSeconds(): int|null
    {
        return $this->tolerationSeconds;
    }

    public function getValue(): string|null
    {
        return $this->value;
    }

    public function setEffect(string $effect): self
    {
        $this->effect = $effect;

        return $this;
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

    public function setTolerationSeconds(int $tolerationSeconds): self
    {
        $this->tolerationSeconds = $tolerationSeconds;

        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'effect' => $this->effect,
            'key' => $this->key,
            'operator' => $this->operator,
            'tolerationSeconds' => $this->tolerationSeconds,
            'value' => $this->value,
        ];
    }
}
