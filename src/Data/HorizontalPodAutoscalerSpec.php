<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * specification of a horizontal pod autoscaler.
 */
class HorizontalPodAutoscalerSpec implements JsonSerializable
{
    /**
     * upper limit for the number of pods that can be set by the autoscaler; cannot be
     * smaller than MinReplicas.
     */
    private int $maxReplicas;

    /**
     * minReplicas is the lower limit for the number of replicas to which the
     * autoscaler can scale down.  It defaults to 1 pod.  minReplicas is allowed to be
     * 0 if the alpha feature gate HPAScaleToZero is enabled and at least one Object or
     * External metric is configured.  Scaling is active as long as at least one metric
     * value is available.
     */
    private int|null $minReplicas = null;

    /**
     * reference to scaled resource; horizontal pod autoscaler will learn the current
     * resource consumption and will set the desired number of pods by using its Scale
     * subresource.
     */
    private CrossVersionObjectReference $scaleTargetRef;

    /**
     * target average CPU utilization (represented as a percentage of requested CPU)
     * over all the pods; if not specified the default autoscaling policy will be used.
     */
    private int|null $targetCPUUtilizationPercentage = null;

    public function __construct(int $maxReplicas, CrossVersionObjectReference $scaleTargetRef)
    {
        $this->maxReplicas = $maxReplicas;
        $this->scaleTargetRef = $scaleTargetRef;
    }

    public function getMaxReplicas(): int
    {
        return $this->maxReplicas;
    }

    public function getMinReplicas(): int|null
    {
        return $this->minReplicas;
    }

    public function getScaleTargetRef(): CrossVersionObjectReference
    {
        return $this->scaleTargetRef;
    }

    public function getTargetCPUUtilizationPercentage(): int|null
    {
        return $this->targetCPUUtilizationPercentage;
    }

    public function setMaxReplicas(int $maxReplicas): self
    {
        $this->maxReplicas = $maxReplicas;

        return $this;
    }

    public function setMinReplicas(int $minReplicas): self
    {
        $this->minReplicas = $minReplicas;

        return $this;
    }

    public function setScaleTargetRef(CrossVersionObjectReference $scaleTargetRef): self
    {
        $this->scaleTargetRef = $scaleTargetRef;

        return $this;
    }

    public function setTargetCPUUtilizationPercentage(int $targetCPUUtilizationPercentage): self
    {
        $this->targetCPUUtilizationPercentage = $targetCPUUtilizationPercentage;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'maxReplicas' => $this->maxReplicas,
            'minReplicas' => $this->minReplicas,
            'scaleTargetRef' => $this->scaleTargetRef,
            'targetCPUUtilizationPercentage' => $this->targetCPUUtilizationPercentage,
        ];
    }
}
