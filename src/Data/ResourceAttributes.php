<?php 

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
     *
     * @var string|null
     */
    private ?string $group = null;

    /**
     * Name is the name of the resource being requested for a "get" or deleted for a
     * "delete". "" (empty) means all.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Namespace is the namespace of the action being requested.  Currently, there is
     * no distinction between no namespace and all namespaces "" (empty) is defaulted
     * for LocalSubjectAccessReviews "" (empty) is empty for cluster-scoped resources
     * "" (empty) means "all" for namespace scoped resources from a SubjectAccessReview
     * or SelfSubjectAccessReview
     *
     * @var string|null
     */
    private ?string $namespace = null;

    /**
     * Resource is one of the existing resource types.  "*" means all.
     *
     * @var string|null
     */
    private ?string $resource = null;

    /**
     * Subresource is one of the existing resource types.  "" means none.
     *
     * @var string|null
     */
    private ?string $subresource = null;

    /**
     * Verb is a kubernetes resource API verb, like: get, list, watch, create, update,
     * delete, proxy.  "*" means all.
     *
     * @var string|null
     */
    private ?string $verb = null;

    /**
     * Version is the API Version of the Resource.  "*" means all.
     *
     * @var string|null
     */
    private ?string $version = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    /**
     * @return string|null
     */
    public function getResource(): ?string
    {
        return $this->resource;
    }

    /**
     * @return string|null
     */
    public function getSubresource(): ?string
    {
        return $this->subresource;
    }

    /**
     * @return string|null
     */
    public function getVerb(): ?string
    {
        return $this->verb;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
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

    public function jsonSerialize()
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
