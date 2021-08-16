<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * ResourcePolicyRule is a predicate that matches some resource requests, testing
 * the request's verb and the target resource. A ResourcePolicyRule matches a
 * resource request if and only if: (a) at least one member of verbs matches the
 * request, (b) at least one member of apiGroups matches the request, (c) at least
 * one member of resources matches the request, and (d) least one member of
 * namespaces matches the request.
 */
class ResourcePolicyRule implements JsonSerializable
{
    /**
     * `apiGroups` is a list of matching API groups and may not be empty. "*" matches
     * all API groups and, if present, must be the only entry. Required.
     */
    private StringList $apiGroups;

    /**
     * `clusterScope` indicates whether to match requests that do not specify a
     * namespace (which happens either because the resource is not namespaced or the
     * request targets all namespaces). If this field is omitted or false then the
     * `namespaces` field must contain a non-empty list.
     */
    private bool|null $clusterScope = null;

    /**
     * `namespaces` is a list of target namespaces that restricts matches.  A request
     * that specifies a target namespace matches only if either (a) this list contains
     * that target namespace or (b) this list contains "*".  Note that "*" matches any
     * specified namespace but does not match a request that _does not specify_ a
     * namespace (see the `clusterScope` field for that). This list may be empty, but
     * only if `clusterScope` is true.
     */
    private StringList $namespaces;

    /**
     * `resources` is a list of matching resources (i.e., lowercase and plural) with,
     * if desired, subresource.  For example, [ "services", "nodes/status" ].  This
     * list may not be empty. "*" matches all resources and, if present, must be the
     * only entry. Required.
     */
    private StringList $resources;

    /**
     * `verbs` is a list of matching verbs and may not be empty. "*" matches all verbs
     * and, if present, must be the only entry. Required.
     */
    private StringList $verbs;

    public function __construct()
    {
        $this->apiGroups = new StringList();
        $this->namespaces = new StringList();
        $this->resources = new StringList();
        $this->verbs = new StringList();
    }

    public function apiGroups(): StringList
    {
        return $this->apiGroups;
    }

    public function getClusterScope(): bool|null
    {
        return $this->clusterScope;
    }

    public function namespaces(): StringList
    {
        return $this->namespaces;
    }

    public function resources(): StringList
    {
        return $this->resources;
    }

    public function setClusterScope(bool $clusterScope): self
    {
        $this->clusterScope = $clusterScope;

        return $this;
    }

    public function verbs(): StringList
    {
        return $this->verbs;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiGroups' => $this->apiGroups,
            'clusterScope' => $this->clusterScope,
            'namespaces' => $this->namespaces,
            'resources' => $this->resources,
            'verbs' => $this->verbs,
        ];
    }
}
