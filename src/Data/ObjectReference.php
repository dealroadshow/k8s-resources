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
     */
    private string|null $apiVersion = null;

    /**
     * If referring to a piece of an object instead of an entire object, this string
     * should contain a valid JSON/Go field access statement, such as
     * desiredState.manifest.containers[2]. For example, if the object reference is to
     * a container within a pod, this would take on a value like:
     * "spec.containers{name}" (where "name" refers to the name of the container that
     * triggered the event) or if no container name is specified "spec.containers[2]"
     * (container with index 2 in this pod). This syntax is chosen only to have some
     * well-defined way of referencing a part of an object.
     */
    private string|null $fieldPath = null;

    /**
     * Kind of the referent. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private string|null $kind = null;

    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string|null $name = null;

    /**
     * Namespace of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/namespaces/
     */
    private string|null $namespace = null;

    /**
     * Specific resourceVersion to which this reference is made, if any. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#concurrency-control-and-consistency
     */
    private string|null $resourceVersion = null;

    /**
     * UID of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#uids
     */
    private string|null $uid = null;

    public function __construct()
    {
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getFieldPath(): string|null
    {
        return $this->fieldPath;
    }

    public function getKind(): string|null
    {
        return $this->kind;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getNamespace(): string|null
    {
        return $this->namespace;
    }

    public function getResourceVersion(): string|null
    {
        return $this->resourceVersion;
    }

    public function getUid(): string|null
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

    public function jsonSerialize(): array
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
