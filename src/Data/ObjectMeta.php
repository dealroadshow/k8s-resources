<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ManagedFieldsEntryList;
use Dealroadshow\K8S\Data\Collection\OwnerReferenceList;
use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\StringMap;
use JsonSerializable;

/**
 * ObjectMeta is metadata that all persisted resources must have, which includes
 * all objects users must create.
 */
class ObjectMeta implements JsonSerializable
{
    /**
     * Annotations is an unstructured key value map stored with a resource that may be
     * set by external tools to store and retrieve arbitrary metadata. They are not
     * queryable and should be preserved when modifying objects. More info:
     * http://kubernetes.io/docs/user-guide/annotations
     */
    private StringMap $annotations;

    /**
     * The name of the cluster which the object belongs to. This is used to distinguish
     * resources with same name and namespace in different clusters. This field is not
     * set anywhere right now and apiserver is going to ignore it if set in create or
     * update request.
     */
    private string|null $clusterName = null;

    /**
     * Number of seconds allowed for this object to gracefully terminate before it will
     * be removed from the system. Only set when deletionTimestamp is also set. May
     * only be shortened. Read-only.
     */
    private int|null $deletionGracePeriodSeconds = null;

    /**
     * Must be empty before the object is deleted from the registry. Each entry is an
     * identifier for the responsible component that will remove the entry from the
     * list. If the deletionTimestamp of the object is non-nil, entries in this list
     * can only be removed.
     */
    private StringList $finalizers;

    /**
     * GenerateName is an optional prefix, used by the server, to generate a unique
     * name ONLY IF the Name field has not been provided. If this field is used, the
     * name returned to the client will be different than the name passed. This value
     * will also be combined with a unique suffix. The provided value has the same
     * validation rules as the Name field, and may be truncated by the length of the
     * suffix required to make the value unique on the server.
     *
     * If this field is specified and the generated name exists, the server will NOT
     * return a 409 - instead, it will either return 201 Created or 500 with Reason
     * ServerTimeout indicating a unique name could not be found in the time allotted,
     * and the client should retry (optionally after the time indicated in the
     * Retry-After header).
     *
     * Applied only if Name is not specified. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#idempotency
     */
    private string|null $generateName = null;

    /**
     * Map of string keys and values that can be used to organize and categorize (scope
     * and select) objects. May match selectors of replication controllers and
     * services. More info: http://kubernetes.io/docs/user-guide/labels
     */
    private StringMap $labels;

    /**
     * ManagedFields maps workflow-id and version to the set of fields that are managed
     * by that workflow. This is mostly for internal housekeeping, and users typically
     * shouldn't need to set or understand this field. A workflow can be the user's
     * name, a controller's name, or the name of a specific apply path like "ci-cd".
     * The set of fields is always in the version that the workflow used when modifying
     * the object.
     */
    private ManagedFieldsEntryList $managedFields;

    /**
     * Name must be unique within a namespace. Is required when creating resources,
     * although some resources may allow a client to request the generation of an
     * appropriate name automatically. Name is primarily intended for creation
     * idempotence and configuration definition. Cannot be updated. More info:
     * http://kubernetes.io/docs/user-guide/identifiers#names
     */
    private string|null $name = null;

    /**
     * Namespace defines the space within each name must be unique. An empty namespace
     * is equivalent to the "default" namespace, but "default" is the canonical
     * representation. Not all objects are required to be scoped to a namespace - the
     * value of this field for those objects will be empty.
     *
     * Must be a DNS_LABEL. Cannot be updated. More info:
     * http://kubernetes.io/docs/user-guide/namespaces
     */
    private string|null $namespace = null;

    /**
     * List of objects depended by this object. If ALL objects in the list have been
     * deleted, this object will be garbage collected. If this object is managed by a
     * controller, then an entry in this list will point to this controller, with the
     * controller field set to true. There cannot be more than one managing controller.
     */
    private OwnerReferenceList $ownerReferences;

    public function __construct()
    {
        $this->annotations = new StringMap();
        $this->finalizers = new StringList();
        $this->labels = new StringMap();
        $this->managedFields = new ManagedFieldsEntryList();
        $this->ownerReferences = new OwnerReferenceList();
    }

    public function annotations(): StringMap
    {
        return $this->annotations;
    }

    public function finalizers(): StringList
    {
        return $this->finalizers;
    }

    public function getClusterName(): string|null
    {
        return $this->clusterName;
    }

    public function getDeletionGracePeriodSeconds(): int|null
    {
        return $this->deletionGracePeriodSeconds;
    }

    public function getGenerateName(): string|null
    {
        return $this->generateName;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getNamespace(): string|null
    {
        return $this->namespace;
    }

    public function labels(): StringMap
    {
        return $this->labels;
    }

    public function managedFields(): ManagedFieldsEntryList
    {
        return $this->managedFields;
    }

    public function ownerReferences(): OwnerReferenceList
    {
        return $this->ownerReferences;
    }

    public function setClusterName(string $clusterName): self
    {
        $this->clusterName = $clusterName;

        return $this;
    }

    public function setDeletionGracePeriodSeconds(int $deletionGracePeriodSeconds): self
    {
        $this->deletionGracePeriodSeconds = $deletionGracePeriodSeconds;

        return $this;
    }

    public function setGenerateName(string $generateName): self
    {
        $this->generateName = $generateName;

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

    public function jsonSerialize(): array
    {
        return [
            'annotations' => $this->annotations,
            'clusterName' => $this->clusterName,
            'deletionGracePeriodSeconds' => $this->deletionGracePeriodSeconds,
            'finalizers' => $this->finalizers,
            'generateName' => $this->generateName,
            'labels' => $this->labels,
            'managedFields' => $this->managedFields,
            'name' => $this->name,
            'namespace' => $this->namespace,
            'ownerReferences' => $this->ownerReferences,
        ];
    }
}
