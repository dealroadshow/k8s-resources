<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SELinuxStrategyOptions defines the strategy type and any options used to create
 * the strategy. Deprecated: use SELinuxStrategyOptions from policy API Group
 * instead.
 */
class SELinuxStrategyOptions implements JsonSerializable
{
    /**
     * rule is the strategy that will dictate the allowable labels that may be set.
     */
    private string $rule;

    /**
     * seLinuxOptions required to run as; required for MustRunAs More info:
     * https://kubernetes.io/docs/tasks/configure-pod-container/security-context/
     */
    private SELinuxOptions $seLinuxOptions;

    public function __construct(string $rule)
    {
        $this->rule = $rule;
        $this->seLinuxOptions = new SELinuxOptions();
    }

    public function getRule(): string
    {
        return $this->rule;
    }

    public function seLinuxOptions(): SELinuxOptions
    {
        return $this->seLinuxOptions;
    }

    public function setRule(string $rule): self
    {
        $this->rule = $rule;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'rule' => $this->rule,
            'seLinuxOptions' => $this->seLinuxOptions,
        ];
    }
}
