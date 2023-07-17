<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * StatefulSetOrdinals describes the policy used for replica ordinal assignment in
 * this StatefulSet.
 */
class StatefulSetOrdinals implements JsonSerializable
{
    /**
     * start is the number representing the first replica's index. It may be used to
     * number replicas from an alternate index (eg: 1-indexed) over the default
     * 0-indexed names, or to orchestrate progressive movement of replicas from one
     * StatefulSet to another. If set, replica indices will be in the range:
     *   [.spec.ordinals.start, .spec.ordinals.start + .spec.replicas).
     * If unset, defaults to 0. Replica indices will be in the range:
     *   [0, .spec.replicas).
     */
    private int|null $start = null;

    public function __construct()
    {
    }

    public function getStart(): int|null
    {
        return $this->start;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'start' => $this->start,
        ];
    }
}
