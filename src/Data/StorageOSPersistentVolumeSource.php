<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a StorageOS persistent volume resource.
 */
class StorageOSPersistentVolumeSource implements JsonSerializable
{
    /**
     * fsType is the filesystem type to mount. Must be a filesystem type supported by
     * the host operating system. Ex. "ext4", "xfs", "ntfs". Implicitly inferred to be
     * "ext4" if unspecified.
     */
    private string|null $fsType = null;

    /**
     * readOnly defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts.
     */
    private bool|null $readOnly = null;

    /**
     * secretRef specifies the secret to use for obtaining the StorageOS API
     * credentials.  If not specified, default values will be attempted.
     */
    private ObjectReference $secretRef;

    /**
     * volumeName is the human-readable name of the StorageOS volume.  Volume names are
     * only unique within a namespace.
     */
    private string|null $volumeName = null;

    /**
     * volumeNamespace specifies the scope of the volume within StorageOS.  If no
     * namespace is specified then the Pod's namespace will be used.  This allows the
     * Kubernetes name scoping to be mirrored within StorageOS for tighter integration.
     * Set VolumeName to any name to override the default behaviour. Set to "default"
     * if you are not using namespaces within StorageOS. Namespaces that do not
     * pre-exist within StorageOS will be created.
     */
    private string|null $volumeNamespace = null;

    public function __construct()
    {
        $this->secretRef = new ObjectReference();
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getVolumeName(): string|null
    {
        return $this->volumeName;
    }

    public function getVolumeNamespace(): string|null
    {
        return $this->volumeNamespace;
    }

    public function secretRef(): ObjectReference
    {
        return $this->secretRef;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setVolumeName(string $volumeName): self
    {
        $this->volumeName = $volumeName;

        return $this;
    }

    public function setVolumeNamespace(string $volumeNamespace): self
    {
        $this->volumeNamespace = $volumeNamespace;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'fsType' => $this->fsType,
            'readOnly' => $this->readOnly,
            'secretRef' => $this->secretRef,
            'volumeName' => $this->volumeName,
            'volumeNamespace' => $this->volumeNamespace,
        ];
    }
}
