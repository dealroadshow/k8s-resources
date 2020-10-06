<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ScopedResourceSelectorRequirementList;
use JsonSerializable;

/**
 * A scope selector represents the AND of the selectors represented by the
 * scoped-resource selector requirements.
 */
class ScopeSelector implements JsonSerializable
{
    /**
     * A list of scope selector requirements by scope of the resources.
     */
    private ScopedResourceSelectorRequirementList $matchExpressions;

    public function __construct()
    {
        $this->matchExpressions = new ScopedResourceSelectorRequirementList();
    }

    public function matchExpressions(): ScopedResourceSelectorRequirementList
    {
        return $this->matchExpressions;
    }

    public function jsonSerialize()
    {
        return [
            'matchExpressions' => $this->matchExpressions,
        ];
    }
}
