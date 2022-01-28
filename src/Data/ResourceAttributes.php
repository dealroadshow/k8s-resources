<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ResourceAttributes includes the authorization attributes available for resource
 * requests to the Authorizer interface
 */
class ResourceAttributes implements JsonSerializable
{
    /**
     * Group is the API Group of the Resource.  "*" means all.
     */
    private string|null $group = null;

    /**
     * Name is the name of the resource being requested for a "get" or deleted for a
     * "delete". "" (empty) means all.
     */
    private string|null $name = null;

    /**
     * Namespace is the namespace of the action being requested.  Currently, there is
     * no distinction between no namespace and all namespaces "" (empty) is defaulted
     * for LocalSubjectAccessReviews "" (empty) is empty for cluster-scoped resources
     * "" (empty) means "all" for namespace scoped resources from a SubjectAccessReview
     * or SelfSubjectAccessReview
     */
    private string|null $namespace = null;

    /**
     * Resource is one of the existing resource types.  "*" means all.
     */
    private string|null $resource = null;

    /**
     * Subresource is one of the existing resource types.  "" means none.
     */
    private string|null $subresource = null;

    /**
     * Verb is a kubernetes resource API verb, like: get, list, watch, create, update,
     * delete, proxy.  "*" means all.
     */
    private string|null $verb = null;

    /**
     * Version is the API Version of the Resource.  "*" means all.
     */
    private string|null $version = null;

    public function __construct()
    {
    }

    public function getGroup(): string|null
    {
        return $this->group;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getNamespace(): string|null
    {
        return $this->namespace;
    }

    public function getResource(): string|null
    {
        return $this->resource;
    }

    public function getSubresource(): string|null
    {
        return $this->subresource;
    }

    public function getVerb(): string|null
    {
        return $this->verb;
    }

    public function getVersion(): string|null
    {
        return $this->version;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

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

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function setSubresource(string $subresource): self
    {
        $this->subresource = $subresource;

        return $this;
    }

    public function setVerb(string $verb): self
    {
        $this->verb = $verb;

        return $this;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'group' => $this->group,
            'name' => $this->name,
            'namespace' => $this->namespace,
            'resource' => $this->resource,
            'subresource' => $this->subresource,
            'verb' => $this->verb,
            'version' => $this->version,
        ];
    }
}
