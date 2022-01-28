<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\IDRangeList;
use JsonSerializable;

/**
 * SupplementalGroupsStrategyOptions defines the strategy type and options used to
 * create the strategy.
 */
class SupplementalGroupsStrategyOptions implements JsonSerializable
{
    /**
     * ranges are the allowed ranges of supplemental groups.  If you would like to
     * force a single supplemental group then supply a single range with the same start
     * and end. Required for MustRunAs.
     */
    private IDRangeList $ranges;

    /**
     * rule is the strategy that will dictate what supplemental groups is used in the
     * SecurityContext.
     */
    private string|null $rule = null;

    public function __construct()
    {
        $this->ranges = new IDRangeList();
    }

    public function getRule(): string|null
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
