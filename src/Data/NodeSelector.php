<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\NodeSelectorTermList;
use JsonSerializable;

/**
 * A node selector represents the union of the results of one or more label queries
 * over a set of nodes; that is, it represents the OR of the selectors represented
 * by the node selector terms.
 */
class NodeSelector implements JsonSerializable
{
    /**
     * Required. A list of node selector terms. The terms are ORed.
     */
    private NodeSelectorTermList $nodeSelectorTerms;

    public function __construct()
    {
        $this->nodeSelectorTerms = new NodeSelectorTermList();
    }

    public function nodeSelectorTerms(): NodeSelectorTermList
    {
        return $this->nodeSelectorTerms;
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeSelectorTerms' => $this->nodeSelectorTerms,
        ];
    }
}
