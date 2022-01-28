<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodDisruptionBudgetSpec is a description of a PodDisruptionBudget.
 */
class PodDisruptionBudgetSpec implements JsonSerializable
{
    /**
     * An eviction is allowed if at most "maxUnavailable" pods selected by "selector"
     * are unavailable after the eviction, i.e. even in absence of the evicted pod. For
     * example, one can prevent all voluntary evictions by specifying 0. This is a
     * mutually exclusive setting with "minAvailable".
     */
    private string|int|null $maxUnavailable = null;

    /**
     * An eviction is allowed if at least "minAvailable" pods selected by "selector"
     * will still be available after the eviction, i.e. even in the absence of the
     * evicted pod.  So for example you can prevent all voluntary evictions by
     * specifying "100%".
     */
    private string|int|null $minAvailable = null;

    /**
     * Label query over pods whose evictions are managed by the disruption budget. A
     * null selector will match no pods, while an empty ({}) selector will select all
     * pods within the namespace.
     */
    private LabelSelector $selector;

    public function __construct()
    {
        $this->selector = new LabelSelector();
    }

    public function getMaxUnavailable(): string|int|null
    {
        return $this->maxUnavailable;
    }

    public function getMinAvailable(): string|int|null
    {
        return $this->minAvailable;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function setMaxUnavailable(string|int $maxUnavailable): self
    {
        $this->maxUnavailable = $maxUnavailable;

        return $this;
    }

    public function setMinAvailable(string|int $minAvailable): self
    {
        $this->minAvailable = $minAvailable;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'maxUnavailable' => $this->maxUnavailable,
            'minAvailable' => $this->minAvailable,
            'selector' => $this->selector,
        ];
    }
}
