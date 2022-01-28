<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * DeleteOptions may be provided when deleting an API object.
 */
class DeleteOptions implements JsonSerializable
{
    /**
     * APIVersion defines the versioned schema of this representation of an object.
     * Servers should convert recognized schemas to the latest internal value, and may
     * reject unrecognized values. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#resources
     */
    private string|null $apiVersion = null;

    /**
     * When present, indicates that modifications should not be persisted. An invalid
     * or unrecognized dryRun directive will result in an error response and no further
     * processing of the request. Valid values are: - All: all dry run stages will be
     * processed
     */
    private StringList $dryRun;

    /**
     * The duration in seconds before the object should be deleted. Value must be
     * non-negative integer. The value zero indicates delete immediately. If this value
     * is nil, the default grace period for the specified type will be used. Defaults
     * to a per object value if not specified. zero means delete immediately.
     */
    private int|null $gracePeriodSeconds = null;

    /**
     * Kind is a string value representing the REST resource this object represents.
     * Servers may infer this from the endpoint the client submits requests to. Cannot
     * be updated. In CamelCase. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private string|null $kind = null;

    /**
     * Deprecated: please use the PropagationPolicy, this field will be deprecated in
     * 1.7. Should the dependent objects be orphaned. If true/false, the "orphan"
     * finalizer will be added to/removed from the object's finalizers list. Either
     * this field or PropagationPolicy may be set, but not both.
     */
    private bool|null $orphanDependents = null;

    /**
     * Must be fulfilled before a deletion is carried out. If not possible, a 409
     * Conflict status will be returned.
     */
    private Preconditions $preconditions;

    /**
     * Whether and how garbage collection will be performed. Either this field or
     * OrphanDependents may be set, but not both. The default policy is decided by the
     * existing finalizer set in the metadata.finalizers and the resource-specific
     * default policy. Acceptable values are: 'Orphan' - orphan the dependents;
     * 'Background' - allow the garbage collector to delete the dependents in the
     * background; 'Foreground' - a cascading policy that deletes all dependents in the
     * foreground.
     */
    private string|null $propagationPolicy = null;

    public function __construct()
    {
        $this->dryRun = new StringList();
        $this->preconditions = new Preconditions();
    }

    public function dryRun(): StringList
    {
        return $this->dryRun;
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getGracePeriodSeconds(): int|null
    {
        return $this->gracePeriodSeconds;
    }

    public function getKind(): string|null
    {
        return $this->kind;
    }

    public function getOrphanDependents(): bool|null
    {
        return $this->orphanDependents;
    }

    public function getPropagationPolicy(): string|null
    {
        return $this->propagationPolicy;
    }

    public function preconditions(): Preconditions
    {
        return $this->preconditions;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setGracePeriodSeconds(int $gracePeriodSeconds): self
    {
        $this->gracePeriodSeconds = $gracePeriodSeconds;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setOrphanDependents(bool $orphanDependents): self
    {
        $this->orphanDependents = $orphanDependents;

        return $this;
    }

    public function setPropagationPolicy(string $propagationPolicy): self
    {
        $this->propagationPolicy = $propagationPolicy;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => $this->apiVersion,
            'dryRun' => $this->dryRun,
            'gracePeriodSeconds' => $this->gracePeriodSeconds,
            'kind' => $this->kind,
            'orphanDependents' => $this->orphanDependents,
            'preconditions' => $this->preconditions,
            'propagationPolicy' => $this->propagationPolicy,
        ];
    }
}
