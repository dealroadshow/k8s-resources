<?php

declare(strict_types=1);

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
     * This field can be used to specify either: * An existing VolumeSnapshot object
     * (snapshot.storage.k8s.io/VolumeSnapshot) * An existing PVC
     * (PersistentVolumeClaim) * An existing custom resource that implements data
     * population (Alpha) In order to use custom resource types that implement data
     * population, the AnyVolumeDataSource feature gate must be enabled. If the
     * provisioner or an external controller can support the specified data source, it
     * will create a new volume based on the contents of the specified data source.
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
     * Filesystem is implied when not included in claim spec.
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
