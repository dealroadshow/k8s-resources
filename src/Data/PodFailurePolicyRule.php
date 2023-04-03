<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\PodFailurePolicyOnPodConditionsPatternList;
use JsonSerializable;

/**
 * PodFailurePolicyRule describes how a pod failure is handled when the
 * requirements are met. One of OnExitCodes and onPodConditions, but not both, can
 * be used in each rule.
 */
class PodFailurePolicyRule implements JsonSerializable
{
    /**
     * Specifies the action taken on a pod failure when the requirements are satisfied.
     * Possible values are: - FailJob: indicates that the pod's job is marked as Failed
     * and all
     *   running pods are terminated.
     * - Ignore: indicates that the counter towards the .backoffLimit is not
     *   incremented and a replacement pod is created.
     * - Count: indicates that the pod is handled in the default way - the
     *   counter towards the .backoffLimit is incremented.
     * Additional values are considered to be added in the future. Clients should react
     * to an unknown action by skipping the rule.
     */
    private string $action;

    /**
     * Represents the requirement on the container exit codes.
     */
    private PodFailurePolicyOnExitCodesRequirement|null $onExitCodes = null;

    /**
     * Represents the requirement on the pod conditions. The requirement is represented
     * as a list of pod condition patterns. The requirement is satisfied if at least
     * one pattern matches an actual pod condition. At most 20 elements are allowed.
     */
    private PodFailurePolicyOnPodConditionsPatternList $onPodConditions;

    public function __construct(string $action)
    {
        $this->action = $action;
        $this->onPodConditions = new PodFailurePolicyOnPodConditionsPatternList();
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getOnExitCodes(): PodFailurePolicyOnExitCodesRequirement|null
    {
        return $this->onExitCodes;
    }

    public function onPodConditions(): PodFailurePolicyOnPodConditionsPatternList
    {
        return $this->onPodConditions;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function setOnExitCodes(PodFailurePolicyOnExitCodesRequirement $onExitCodes): self
    {
        $this->onExitCodes = $onExitCodes;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'action' => $this->action,
            'onExitCodes' => $this->onExitCodes,
            'onPodConditions' => $this->onPodConditions,
        ];
    }
}
