<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\NodeSelectorRequirementList;
use JsonSerializable;

/**
 * A null or empty node selector term matches no objects. The requirements of them
 * are ANDed. The TopologySelectorTerm type implements a subset of the
 * NodeSelectorTerm.
 */
class NodeSelectorTerm implements JsonSerializable
{
    /**
     * A list of node selector requirements by node's labels.
     */
    private NodeSelectorRequirementList $matchExpressions;

    /**
     * A list of node selector requirements by node's fields.
     */
    private NodeSelectorRequirementList $matchFields;

    public function __construct()
    {
        $this->matchExpressions = new NodeSelectorRequirementList();
        $this->matchFields = new NodeSelectorRequirementList();
    }

    public function matchExpressions(): NodeSelectorRequirementList
    {
        return $this->matchExpressions;
    }

    public function matchFields(): NodeSelectorRequirementList
    {
        return $this->matchFields;
    }

    public function jsonSerialize(): array
    {
        return [
            'matchExpressions' => $this->matchExpressions,
            'matchFields' => $this->matchFields,
        ];
    }
}
