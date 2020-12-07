<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\IDRangeList;
use JsonSerializable;

/**
 * RunAsUserStrategyOptions defines the strategy type and any options used to
 * create the strategy. Deprecated: use RunAsUserStrategyOptions from policy API
 * Group instead.
 */
class RunAsUserStrategyOptions implements JsonSerializable
{
    /**
     * ranges are the allowed ranges of uids that may be used. If you would like to
     * force a single uid then supply a single range with the same start and end.
     * Required for MustRunAs.
     */
    private IDRangeList $ranges;

    /**
     * rule is the strategy that will dictate the allowable RunAsUser values that may
     * be set.
     */
    private string $rule;

    public function __construct(string $rule)
    {
        $this->ranges = new IDRangeList();
        $this->rule = $rule;
    }

    public function getRule(): string
    {
        return $this->rule;
    }

    public function ranges(): IDRangeList
    {
        return $this->ranges;
    }

    public function setRule(string $rule): self
    {
        $this->rule = $rule;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'ranges' => $this->ranges,
            'rule' => $this->rule,
        ];
    }
}
