<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\LabelSelectorList;
use JsonSerializable;

/**
 * AggregationRule describes how to locate ClusterRoles to aggregate into the
 * ClusterRole
 */
class AggregationRule implements JsonSerializable
{
    /**
     * ClusterRoleSelectors holds a list of selectors which will be used to find
     * ClusterRoles and create the rules. If any of the selectors match, then the
     * ClusterRole's permissions will be added
     */
    private LabelSelectorList $clusterRoleSelectors;

    public function __construct()
    {
        $this->clusterRoleSelectors = new LabelSelectorList();
    }

    public function clusterRoleSelectors(): LabelSelectorList
    {
        return $this->clusterRoleSelectors;
    }

    public function jsonSerialize(): array
    {
        return [
            'clusterRoleSelectors' => $this->clusterRoleSelectors,
        ];
    }
}
