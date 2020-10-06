<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\IntOrString;
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
     *
     * @var IntOrString|null
     */
    private ?IntOrString $maxUnavailable = null;

    /**
     * An eviction is allowed if at least "minAvailable" pods selected by "selector"
     * will still be available after the eviction, i.e. even in the absence of the
     * evicted pod.  So for example you can prevent all voluntary evictions by
     * specifying "100%".
     *
     * @var IntOrString|null
     */
    private ?IntOrString $minAvailable = null;

    /**
     * Label query over pods whose evictions are managed by the disruption budget.
     */
    private LabelSelector $selector;

    public function __construct()
    {
        $this->selector = new LabelSelector();
    }

    /**
     * @return IntOrString|null
     */
    public function getMaxUnavailable(): ?IntOrString
    {
        return $this->maxUnavailable;
    }

    /**
     * @return IntOrString|null
     */
    public function getMinAvailable(): ?IntOrString
    {
        return $this->minAvailable;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function setMaxUnavailable(IntOrString $maxUnavailable): self
    {
        $this->maxUnavailable = $maxUnavailable;

        return $this;
    }

    public function setMinAvailable(IntOrString $minAvailable): self
    {
        $this->minAvailable = $minAvailable;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'maxUnavailable' => $this->maxUnavailable,
            'minAvailable' => $this->minAvailable,
            'selector' => $this->selector,
        ];
    }
}
