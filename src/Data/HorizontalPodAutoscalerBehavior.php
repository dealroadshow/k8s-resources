<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * HorizontalPodAutoscalerBehavior configures the scaling behavior of the target in
 * both Up and Down directions (scaleUp and scaleDown fields respectively).
 */
class HorizontalPodAutoscalerBehavior implements JsonSerializable
{
    /**
     * scaleDown is scaling policy for scaling Down. If not set, the default value is
     * to allow to scale down to minReplicas pods, with a 300 second stabilization
     * window (i.e., the highest recommendation for the last 300sec is used).
     */
    private HPAScalingRules $scaleDown;

    /**
     * scaleUp is scaling policy for scaling Up. If not set, the default value is the
     * higher of:
     *   * increase no more than 4 pods per 60 seconds
     *   * double the number of pods per 60 seconds
     * No stabilization is used.
     */
    private HPAScalingRules $scaleUp;

    public function __construct()
    {
        $this->scaleDown = new HPAScalingRules();
        $this->scaleUp = new HPAScalingRules();
    }

    public function scaleDown(): HPAScalingRules
    {
        return $this->scaleDown;
    }

    public function scaleUp(): HPAScalingRules
    {
        return $this->scaleUp;
    }

    public function jsonSerialize(): array
    {
        return [
            'scaleDown' => $this->scaleDown,
            'scaleUp' => $this->scaleUp,
        ];
    }
}
