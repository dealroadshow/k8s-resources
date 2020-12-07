<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * PersistentVolumeClaimSpec describes the common attributes of storage devices and
 * allows a Source for provider-specific attributes
 */
class PersistentVolumeClaimSpec implements JsonSerializable
{
    /**
     * AccessModes contains the desired access modes the volume should have. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#access-modes-1
     */
    private StringList $accessModes;

    /**
     * This field requires the VolumeSnapshotDataSource alpha feature gate to be
     * enabled and currently VolumeSnapshot is the only supported data source. If the
     * provisioner can support VolumeSnapshot data source, it will create a new volume
     * and data will be restored to the volume at the same time. If the provisioner
     * does not support VolumeSnapshot data source, volume will not be created and the
     * failure will be reported as an event. In the future, we plan to support more
     * data source types and the behavior of the provisioner may change.
     */
    private TypedLocalObjectReference|null $dataSource = null;

    /**
     * Resources represents the minimum resources the volume should have. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#resources
     */
    private ResourceRequirements $resources;

    /**
     * A label query over volumes to consider for binding.
     */
    private LabelSelector $selector;

    /**
     * Name of the StorageClass required by the claim. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#class-1
     */
    private string|null $storageClassName = null;

    /**
     * volumeMode defines what type of volume is required by the claim. Value of
     * Filesystem is implied when not included in claim spec. This is a beta feature.
     */
    private string|null $volumeMode = null;

    /**
     * VolumeName is the binding reference to the PersistentVolume backing this claim.
     */
    private string|null $volumeName = null;

    public function __construct()
    {
        $this->accessModes = new StringList();
        $this->resources = new ResourceRequirements();
        $this->selector = new LabelSelector();
    }

    public function accessModes(): StringList
    {
        return $this->accessModes;
    }

    public function getDataSource(): TypedLocalObjectReference|null
    {
        return $this->dataSource;
    }

    public function getStorageClassName(): string|null
    {
        return $this->storageClassName;
    }

    public function getVolumeMode(): string|null
    {
        return $this->volumeMode;
    }

    public function getVolumeName(): string|null
    {
        return $this->volumeName;
    }

    public function resources(): ResourceRequirements
    {
        return $this->resources;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function setDataSource(TypedLocalObjectReference $dataSource): self
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    public function setStorageClassName(string $storageClassName): self
    {
        $this->storageClassName = $storageClassName;

        return $this;
    }

    public function setVolumeMode(string $volumeMode): self
    {
        $this->volumeMode = $volumeMode;

        return $this;
    }

    public function setVolumeName(string $volumeName): self
    {
        $this->volumeName = $volumeName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'accessModes' => $this->accessModes,
            'dataSource' => $this->dataSource,
            'resources' => $this->resources,
            'selector' => $this->selector,
            'storageClassName' => $this->storageClassName,
            'volumeMode' => $this->volumeMode,
            'volumeName' => $this->volumeName,
        ];
    }
}
