<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Storage;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\LabelSelector;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * CSIStorageCapacity stores the result of one CSI GetCapacity call. For a given
 * StorageClass, this describes the available capacity in a particular topology
 * segment.  This can be used when considering where to instantiate new
 * PersistentVolumes.
 *
 * For example this can express things like: - StorageClass "standard" has "1234
 * GiB" available in "topology.kubernetes.io/zone=us-east1" - StorageClass
 * "localssd" has "10 GiB" available in "kubernetes.io/hostname=knode-abc123"
 *
 * The following three cases all imply that no capacity is available for a certain
 * combination: - no object exists with suitable topology and storage class name -
 * such an object exists, but the capacity is unset - such an object exists, but
 * the capacity is zero
 *
 * The producer of these objects can decide which approach is more suitable.
 *
 * They are consumed by the kube-scheduler if the CSIStorageCapacity beta feature
 * gate is enabled there and a CSI driver opts into capacity-aware scheduling with
 * CSIDriver.StorageCapacity.
 */
class CSIStorageCapacity implements APIResourceInterface
{
    public const API_VERSION = 'storage.k8s.io/v1beta1';
    public const KIND = 'CSIStorageCapacity';

    /**
     * Capacity is the value reported by the CSI driver in its GetCapacityResponse for
     * a GetCapacityRequest with topology and parameters that match the previous
     * fields.
     *
     * The semantic is currently (CSI spec 1.2) defined as: The available capacity, in
     * bytes, of the storage that can be used to provision volumes. If not set, that
     * information is currently unavailable and treated like zero capacity.
     */
    private string|float|null $capacity = null;

    /**
     * MaximumVolumeSize is the value reported by the CSI driver in its
     * GetCapacityResponse for a GetCapacityRequest with topology and parameters that
     * match the previous fields.
     *
     * This is defined since CSI spec 1.4.0 as the largest size that may be used in a
     * CreateVolumeRequest.capacity_range.required_bytes field to create a volume with
     * the same parameters as those in GetCapacityRequest. The corresponding value in
     * the Kubernetes API is ResourceRequirements.Requests in a volume claim.
     */
    private string|float|null $maximumVolumeSize = null;

    /**
     * Standard object's metadata. The name has no particular meaning. It must be be a
     * DNS subdomain (dots allowed, 253 characters). To ensure that there are no
     * conflicts with other CSI drivers on the cluster, the recommendation is to use
     * csisc-<uuid>, a generated name, or a reverse-domain name which ends with the
     * unique CSI driver name.
     *
     * Objects are namespaced.
     *
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * NodeTopology defines which nodes have access to the storage for which capacity
     * was reported. If not set, the storage is not accessible from any node in the
     * cluster. If empty, the storage is accessible from all nodes. This field is
     * immutable.
     */
    private LabelSelector $nodeTopology;

    /**
     * The name of the StorageClass that the reported capacity applies to. It must meet
     * the same requirements as the name of a StorageClass object (non-empty, DNS
     * subdomain). If that object no longer exists, the CSIStorageCapacity object is
     * obsolete and should be removed by its creator. This field is immutable.
     */
    private string $storageClassName;

    public function __construct(string $storageClassName)
    {
        $this->metadata = new ObjectMeta();
        $this->nodeTopology = new LabelSelector();
        $this->storageClassName = $storageClassName;
    }

    public function getCapacity(): string|float|null
    {
        return $this->capacity;
    }

    public function getMaximumVolumeSize(): string|float|null
    {
        return $this->maximumVolumeSize;
    }

    public function getStorageClassName(): string
    {
        return $this->storageClassName;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function nodeTopology(): LabelSelector
    {
        return $this->nodeTopology;
    }

    public function setCapacity(string|float $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function setMaximumVolumeSize(string|float $maximumVolumeSize): self
    {
        $this->maximumVolumeSize = $maximumVolumeSize;

        return $this;
    }

    public function setStorageClassName(string $storageClassName): self
    {
        $this->storageClassName = $storageClassName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'capacity' => $this->capacity,
            'maximumVolumeSize' => $this->maximumVolumeSize,
            'metadata' => $this->metadata,
            'nodeTopology' => $this->nodeTopology,
            'storageClassName' => $this->storageClassName,
        ];
    }
}
