<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\StringOrFloatMap;
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
    private StringOrFloatMap $hard;

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
        $this->hard = new StringOrFloatMap();
        $this->scopeSelector = new ScopeSelector();
        $this->scopes = new StringList();
    }

    public function hard(): StringOrFloatMap
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

    public function jsonSerialize(): array
    {
        return [
            'hard' => $this->hard,
            'scopeSelector' => $this->scopeSelector,
            'scopes' => $this->scopes,
        ];
    }
}
