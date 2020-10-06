<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ObjectReference contains enough information to let you inspect or modify the
 * referred object.
 */
class ObjectReference implements JsonSerializable
{
    /**
     * API version of the referent.
     *
     * @var string|null
     */
    private ?string $apiVersion = null;

    /**
     * If referring to a piece of an object instead of an entire object, this string
     * should contain a valid JSON/Go field access statement, such as
     * desiredState.manifest.containers[2]. For example, if the object reference is to
     * a container within a pod, this would take on a value like:
     * "spec.containers{name}" (where "name" refers to the name of the container that
     * triggered the event) or if no container name is specified "spec.containers[2]"
     * (container with index 2 in this pod). This syntax is chosen only to have some
     * well-defined way of referencing a part of an object.
     *
     * @var string|null
     */
    private ?string $fieldPath = null;

    /**
     * Kind of the referent. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     *
     * @var string|null
     */
    private ?string $kind = null;

    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Namespace of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/namespaces/
     *
     * @var string|null
     */
    private ?string $namespace = null;

    /**
     * Specific resourceVersion to which this reference is made, if any. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#concurrency-control-and-consistency
     *
     * @var string|null
     */
    private ?string $resourceVersion = null;

    /**
     * UID of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#uids
     *
     * @var string|null
     */
    private ?string $uid = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    /**
     * @return string|null
     */
    public function getFieldPath(): ?string
    {
        return $this->fieldPath;
    }

    /**
     * @return string|null
     */
    public function getKind(): ?string
    {
        return $this->kind;
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
    public function getResourceVersion(): ?string
    {
        return $this->resourceVersion;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setFieldPath(string $fieldPath): self
    {
        $this->fieldPath = $fieldPath;

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

    public function setResourceVersion(string $resourceVersion): self
    {
        $this->resourceVersion = $resourceVersion;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => $this->apiVersion,
            'fieldPath' => $this->fieldPath,
            'kind' => $this->kind,
            'name' => $this->name,
            'namespace' => $this->namespace,
            'resourceVersion' => $this->resourceVersion,
            'uid' => $this->uid,
        ];
    }
}
