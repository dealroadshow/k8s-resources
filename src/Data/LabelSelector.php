<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\LabelSelectorRequirementList;
use Dealroadshow\K8S\Data\Collection\StringMap;
use JsonSerializable;

/**
 * A label selector is a label query over a set of resources. The result of
 * matchLabels and matchExpressions are ANDed. An empty label selector matches all
 * objects. A null label selector matches no objects.
 */
class LabelSelector implements JsonSerializable
{
    /**
     * matchExpressions is a list of label selector requirements. The requirements are
     * ANDed.
     */
    private LabelSelectorRequirementList $matchExpressions;

    /**
     * matchLabels is a map of {key,value} pairs. A single {key,value} in the
     * matchLabels map is equivalent to an element of matchExpressions, whose key field
     * is "key", the operator is "In", and the values array contains only "value". The
     * requirements are ANDed.
     */
    private StringMap $matchLabels;

    public function __construct()
    {
        $this->matchExpressions = new LabelSelectorRequirementList();
        $this->matchLabels = new StringMap();
    }

    public function matchExpressions(): LabelSelectorRequirementList
    {
        return $this->matchExpressions;
    }

    public function matchLabels(): StringMap
    {
        return $this->matchLabels;
    }

    public function jsonSerialize()
    {
        return [
            'matchExpressions' => $this->matchExpressions,
            'matchLabels' => $this->matchLabels,
        ];
    }
}
