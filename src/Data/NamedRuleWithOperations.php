<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * NamedRuleWithOperations is a tuple of Operations and Resources with
 * ResourceNames.
 */
class NamedRuleWithOperations implements JsonSerializable
{
    /**
     * APIGroups is the API groups the resources belong to. '*' is all groups. If '*'
     * is present, the length of the slice must be one. Required.
     */
    private StringList $apiGroups;

    /**
     * APIVersions is the API versions the resources belong to. '*' is all versions. If
     * '*' is present, the length of the slice must be one. Required.
     */
    private StringList $apiVersions;

    /**
     * Operations is the operations the admission hook cares about - CREATE, UPDATE,
     * DELETE, CONNECT or * for all of those operations and any future admission
     * operations that are added. If '*' is present, the length of the slice must be
     * one. Required.
     */
    private StringList $operations;

    /**
     * ResourceNames is an optional white list of names that the rule applies to.  An
     * empty set means that everything is allowed.
     */
    private StringList $resourceNames;

    /**
     * Resources is a list of resources this rule applies to.
     *
     * For example: 'pods' means pods. 'pods/log' means the log subresource of pods.
     * '*' means all resources, but not subresources. 'pods/*' means all subresources
     * of pods. '* /scale' means all scale subresources. '* /*' means all resources and
     * their subresources.
     *
     * If wildcard is present, the validation rule will ensure resources do not overlap
     * with each other.
     *
     * Depending on the enclosing object, subresources might not be allowed. Required.
     */
    private StringList $resources;

    /**
     * scope specifies the scope of this rule. Valid values are "Cluster",
     * "Namespaced", and "*" "Cluster" means that only cluster-scoped resources will
     * match this rule. Namespace API objects are cluster-scoped. "Namespaced" means
     * that only namespaced resources will match this rule. "*" means that there are no
     * scope restrictions. Subresources match the scope of their parent resource.
     * Default is "*".
     */
    private string|null $scope = null;

    public function __construct()
    {
        $this->apiGroups = new StringList();
        $this->apiVersions = new StringList();
        $this->operations = new StringList();
        $this->resourceNames = new StringList();
        $this->resources = new StringList();
    }

    public function apiGroups(): StringList
    {
        return $this->apiGroups;
    }

    public function apiVersions(): StringList
    {
        return $this->apiVersions;
    }

    public function getScope(): string|null
    {
        return $this->scope;
    }

    public function operations(): StringList
    {
        return $this->operations;
    }

    public function resourceNames(): StringList
    {
        return $this->resourceNames;
    }

    public function resources(): StringList
    {
        return $this->resources;
    }

    public function setScope(string $scope): self
    {
        $this->scope = $scope;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiGroups' => $this->apiGroups,
            'apiVersions' => $this->apiVersions,
            'operations' => $this->operations,
            'resourceNames' => $this->resourceNames,
            'resources' => $this->resources,
            'scope' => $this->scope,
        ];
    }
}
