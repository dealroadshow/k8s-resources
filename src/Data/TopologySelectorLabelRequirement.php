<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * A topology selector requirement is a selector that matches given label. This is
 * an alpha feature and may change in the future.
 */
class TopologySelectorLabelRequirement implements JsonSerializable
{
    /**
     * The label key that the selector applies to.
     */
    private string $key;

    /**
     * An array of string values. One value must match the label to be selected. Each
     * entry in Values is ORed.
     */
    private StringList $values;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->values = new StringList();
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

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
            'values' => $this->values,
        ];
    }
}
