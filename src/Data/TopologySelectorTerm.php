<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\TopologySelectorLabelRequirementList;
use JsonSerializable;

/**
 * A topology selector term represents the result of label queries. A null or empty
 * topology selector term matches no objects. The requirements of them are ANDed.
 * It provides a subset of functionality as NodeSelectorTerm. This is an alpha
 * feature and may change in the future.
 */
class TopologySelectorTerm implements JsonSerializable
{
    /**
     * A list of topology selector requirements by labels.
     */
    private TopologySelectorLabelRequirementList $matchLabelExpressions;

    public function __construct()
    {
        $this->matchLabelExpressions = new TopologySelectorLabelRequirementList();
    }

    public function matchLabelExpressions(): TopologySelectorLabelRequirementList
    {
        return $this->matchLabelExpressions;
    }

    public function jsonSerialize()
    {
        return [
            'matchLabelExpressions' => $this->matchLabelExpressions,
        ];
    }
}
