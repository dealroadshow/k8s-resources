<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * An empty preferred scheduling term matches all objects with implicit weight 0
 * (i.e. it's a no-op). A null preferred scheduling term matches no objects (i.e.
 * is also a no-op).
 */
class PreferredSchedulingTerm implements JsonSerializable
{
    /**
     * A node selector term, associated with the corresponding weight.
     */
    private NodeSelectorTerm $preference;

    /**
     * Weight associated with matching the corresponding nodeSelectorTerm, in the range
     * 1-100.
     */
    private int $weight;

    public function __construct(int $weight)
    {
        $this->preference = new NodeSelectorTerm();
        $this->weight = $weight;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function preference(): NodeSelectorTerm
    {
        return $this->preference;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'preference' => $this->preference,
            'weight' => $this->weight,
        ];
    }
}
