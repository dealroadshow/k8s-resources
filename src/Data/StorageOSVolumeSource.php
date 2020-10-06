<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a StorageOS persistent volume resource.
 */
class StorageOSVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type to mount. Must be a filesystem type supported by the host
     * operating system. Ex. "ext4", "xfs", "ntfs". Implicitly inferred to be "ext4" if
     * unspecified.
     *
     * @var string|null
     */
    private ?string $fsType = null;

    /**
     * Defaults to false (read/write). ReadOnly here will force the ReadOnly setting in
     * VolumeMounts.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    /**
     * SecretRef specifies the secret to use for obtaining the StorageOS API
     * credentials.  If not specified, default values will be attempted.
     */
    private LocalObjectReference $secretRef;

    /**
     * VolumeName is the human-readable name of the StorageOS volume.  Volume names are
     * only unique within a namespace.
     *
     * @var string|null
     */
    private ?string $volumeName = null;

    /**
     * VolumeNamespace specifies the scope of the volume within StorageOS.  If no
     * namespace is specified then the Pod's namespace will be used.  This allows the
     * Kubernetes name scoping to be mirrored within StorageOS for tighter integration.
     * Set VolumeName to any name to override the default behaviour. Set to "default"
     * if you are not using namespaces within StorageOS. Namespaces that do not
     * pre-exist within StorageOS will be created.
     *
     * @var string|null
     */
    private ?string $volumeNamespace = null;

    public function __construct()
    {
        $this->secretRef = new LocalObjectReference();
    }

    /**
     * @return string|null
     */
    public function getFsType(): ?string
    {
        return $this->fsType;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    /**
     * @return string|null
     */
    public function getVolumeName(): ?string
    {
        return $this->volumeName;
    }

    /**
     * @return string|null
     */
    public function getVolumeNamespace(): ?string
    {
        return $this->volumeNamespace;
    }

    public function secretRef(): LocalObjectReference
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

    public function jsonSerialize()
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
