<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * IngressClassParametersReference identifies an API object. This can be used to
 * specify a cluster or namespace-scoped resource.
 */
class IngressClassParametersReference implements JsonSerializable
{
    /**
     * APIGroup is the group for the resource being referenced. If APIGroup is not
     * specified, the specified Kind must be in the core API group. For any other
     * third-party types, APIGroup is required.
     */
    private string|null $apiGroup = null;

    /**
     * Kind is the type of resource being referenced.
     */
    private string $kind;

    /**
     * Name is the name of resource being referenced.
     */
    private string $name;

    /**
     * Namespace is the namespace of the resource being referenced. This field is
     * required when scope is set to "Namespace" and must be unset when scope is set to
     * "Cluster".
     */
    private string|null $namespace = null;

    /**
     * Scope represents if this refers to a cluster or namespace scoped resource. This
     * may be set to "Cluster" (default) or "Namespace". Field can be enabled with
     * IngressClassNamespacedParams feature gate.
     */
    private string|null $scope = null;

    public function __construct(string $kind, string $name)
    {
        $this->kind = $kind;
        $this->name = $name;
    }

    public function getApiGroup(): string|null
    {
        return $this->apiGroup;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNamespace(): string|null
    {
        return $this->namespace;
    }

    public function getScope(): string|null
    {
        return $this->scope;
    }

    public function setApiGroup(string $apiGroup): self
    {
        $this->apiGroup = $apiGroup;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function setScope(string $scope): self
    {
        $this->scope = $scope;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiGroup' => $this->apiGroup,
            'kind' => $this->kind,
            'name' => $this->name,
            'namespace' => $this->namespace,
            'scope' => $this->scope,
        ];
    }
}
