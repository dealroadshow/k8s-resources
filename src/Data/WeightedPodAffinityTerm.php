<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * The weights of all of the matched WeightedPodAffinityTerm fields are added
 * per-node to find the most preferred node(s)
 */
class WeightedPodAffinityTerm implements JsonSerializable
{
    /**
     * Required. A pod affinity term, associated with the corresponding weight.
     */
    private PodAffinityTerm $podAffinityTerm;

    /**
     * weight associated with matching the corresponding podAffinityTerm, in the range
     * 1-100.
     */
    private int $weight;

    public function __construct(PodAffinityTerm $podAffinityTerm, int $weight)
    {
        $this->podAffinityTerm = $podAffinityTerm;
        $this->weight = $weight;
    }

    public function getPodAffinityTerm(): PodAffinityTerm
    {
        return $this->podAffinityTerm;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setPodAffinityTerm(PodAffinityTerm $podAffinityTerm): self
    {
        $this->podAffinityTerm = $podAffinityTerm;

        return $this;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'podAffinityTerm' => $this->podAffinityTerm,
            'weight' => $this->weight,
        ];
    }
}
