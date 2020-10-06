<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\QuantityMap;
use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * ResourceQuotaSpec defines the desired hard limits to enforce for Quota.
 */
class ResourceQuotaSpec implements JsonSerializable
{
    /**
     * hard is the set of desired hard limits for each named resource. More info:
     * https://kubernetes.io/docs/concepts/policy/resource-quotas/
     */
    private QuantityMap $hard;

    /**
     * scopeSelector is also a collection of filters like scopes that must match each
     * object tracked by a quota but expressed using ScopeSelectorOperator in
     * combination with possible values. For a resource to match, both scopes AND
     * scopeSelector (if specified in spec), must be matched.
     */
    private ScopeSelector $scopeSelector;

    /**
     * A collection of filters that must match each object tracked by a quota. If not
     * specified, the quota matches all objects.
     */
    private StringList $scopes;

    public function __construct()
    {
        $this->hard = new QuantityMap();
        $this->scopeSelector = new ScopeSelector();
        $this->scopes = new StringList();
    }

    public function hard(): QuantityMap
    {
        return $this->hard;
    }

    public function scopeSelector(): ScopeSelector
    {
        return $this->scopeSelector;
    }

    public function scopes(): StringList
    {
        return $this->scopes;
    }

    public function jsonSerialize()
    {
        return [
            'hard' => $this->hard,
            'scopeSelector' => $this->scopeSelector,
            'scopes' => $this->scopes,
        ];
    }
}
