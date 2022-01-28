<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * PolicyRule holds information that describes a policy rule, but does not contain
 * information about who the rule applies to or which namespace the rule applies
 * to.
 */
class PolicyRule implements JsonSerializable
{
    /**
     * APIGroups is the name of the APIGroup that contains the resources.  If multiple
     * API groups are specified, any action requested against one of the enumerated
     * resources in any API group will be allowed.
     */
    private StringList $apiGroups;

    /**
     * NonResourceURLs is a set of partial urls that a user should have access to.  *s
     * are allowed, but only as the full, final step in the path Since non-resource
     * URLs are not namespaced, this field is only applicable for ClusterRoles
     * referenced from a ClusterRoleBinding. Rules can either apply to API resources
     * (such as "pods" or "secrets") or non-resource URL paths (such as "/api"),  but
     * not both.
     */
    private StringList $nonResourceURLs;

    /**
     * ResourceNames is an optional white list of names that the rule applies to.  An
     * empty set means that everything is allowed.
     */
    private StringList $resourceNames;

    /**
     * Resources is a list of resources this rule applies to. '*' represents all
     * resources.
     */
    private StringList $resources;

    /**
     * Verbs is a list of Verbs that apply to ALL the ResourceKinds and
     * AttributeRestrictions contained in this rule. '*' represents all verbs.
     */
    private StringList $verbs;

    public function __construct()
    {
        $this->apiGroups = new StringList();
        $this->nonResourceURLs = new StringList();
        $this->resourceNames = new StringList();
        $this->resources = new StringList();
        $this->verbs = new StringList();
    }

    public function apiGroups(): StringList
    {
        return $this->apiGroups;
    }

    public function nonResourceURLs(): StringList
    {
        return $this->nonResourceURLs;
    }

    public function resourceNames(): StringList
    {
        return $this->resourceNames;
    }

    public function resources(): StringList
    {
        return $this->resources;
    }

    public function verbs(): StringList
    {
        return $this->verbs;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiGroups' => $this->apiGroups,
            'nonResourceURLs' => $this->nonResourceURLs,
            'resourceNames' => $this->resourceNames,
            'resources' => $this->resources,
            'verbs' => $this->verbs,
        ];
    }
}
