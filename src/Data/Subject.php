<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Subject contains a reference to the object or user identities a role binding
 * applies to.  This can either hold a direct API object reference, or a value for
 * non-objects such as user and group names.
 */
class Subject implements JsonSerializable
{
    /**
     * APIGroup holds the API group of the referenced subject. Defaults to "" for
     * ServiceAccount subjects. Defaults to "rbac.authorization.k8s.io" for User and
     * Group subjects.
     *
     * @var string|null
     */
    private ?string $apiGroup = null;

    /**
     * Kind of object being referenced. Values defined by this API group are "User",
     * "Group", and "ServiceAccount". If the Authorizer does not recognized the kind
     * value, the Authorizer should report an error.
     */
    private string $kind;

    /**
     * Name of the object being referenced.
     */
    private string $name;

    /**
     * Namespace of the referenced object.  If the object kind is non-namespace, such
     * as "User" or "Group", and this value is not empty the Authorizer should report
     * an error.
     *
     * @var string|null
     */
    private ?string $namespace = null;

    public function __construct(string $kind, string $name)
    {
        $this->kind = $kind;
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getApiGroup(): ?string
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

    /**
     * @return string|null
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
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

    public function jsonSerialize()
    {
        return [
            'apiGroup' => $this->apiGroup,
            'kind' => $this->kind,
            'name' => $this->name,
            'namespace' => $this->namespace,
        ];
    }
}
