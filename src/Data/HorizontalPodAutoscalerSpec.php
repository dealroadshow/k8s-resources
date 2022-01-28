<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\MetricSpecList;
use JsonSerializable;

/**
 * HorizontalPodAutoscalerSpec describes the desired functionality of the
 * HorizontalPodAutoscaler.
 */
class HorizontalPodAutoscalerSpec implements JsonSerializable
{
    /**
     * behavior configures the scaling behavior of the target in both Up and Down
     * directions (scaleUp and scaleDown fields respectively). If not set, the default
     * HPAScalingRules for scale up and scale down are used.
     */
    private HorizontalPodAutoscalerBehavior $behavior;

    /**
     * maxReplicas is the upper limit for the number of replicas to which the
     * autoscaler can scale up. It cannot be less that minReplicas.
     */
    private int $maxReplicas;

    /**
     * metrics contains the specifications for which to use to calculate the desired
     * replica count (the maximum replica count across all metrics will be used).  The
     * desired replica count is calculated multiplying the ratio between the target
     * value and the current value by the current number of pods.  Ergo, metrics used
     * must decrease as the pod count is increased, and vice-versa.  See the individual
     * metric source types for more information about how each type of metric must
     * respond. If not set, the default metric will be set to 80% average CPU
     * utilization.
     */
    private MetricSpecList $metrics;

    /**
     * minReplicas is the lower limit for the number of replicas to which the
     * autoscaler can scale down.  It defaults to 1 pod.  minReplicas is allowed to be
     * 0 if the alpha feature gate HPAScaleToZero is enabled and at least one Object or
     * External metric is configured.  Scaling is active as long as at least one metric
     * value is available.
     */
    private int|null $minReplicas = null;

    /**
     * scaleTargetRef points to the target resource to scale, and is used to the pods
     * for which metrics should be collected, as well as to actually change the replica
     * count.
     */
    private CrossVersionObjectReference $scaleTargetRef;

    public function __construct(int $maxReplicas, CrossVersionObjectReference $scaleTargetRef)
    {
        $this->behavior = new HorizontalPodAutoscalerBehavior();
        $this->maxReplicas = $maxReplicas;
        $this->metrics = new MetricSpecList();
        $this->scaleTargetRef = $scaleTargetRef;
    }

    public function behavior(): HorizontalPodAutoscalerBehavior
    {
        return $this->behavior;
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

    public function metrics(): MetricSpecList
    {
        return $this->metrics;
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

    public function jsonSerialize(): array
    {
        return [
            'behavior' => $this->behavior,
            'maxReplicas' => $this->maxReplicas,
            'metrics' => $this->metrics,
            'minReplicas' => $this->minReplicas,
            'scaleTargetRef' => $this->scaleTargetRef,
        ];
    }
}
