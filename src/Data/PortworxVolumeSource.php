<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PortworxVolumeSource represents a Portworx volume resource.
 */
class PortworxVolumeSource implements JsonSerializable
{
    /**
     * FSType represents the filesystem type to mount Must be a filesystem type
     * supported by the host operating system. Ex. "ext4", "xfs". Implicitly inferred
     * to be "ext4" if unspecified.
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
     * VolumeID uniquely identifies a Portworx volume
     */
    private string $volumeID;

    public function __construct(string $volumeID)
    {
        $this->volumeID = $volumeID;
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

    public function getVolumeID(): string
    {
        return $this->volumeID;
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

    public function setVolumeID(string $volumeID): self
    {
        $this->volumeID = $volumeID;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'fsType' => $this->fsType,
            'readOnly' => $this->readOnly,
            'volumeID' => $this->volumeID,
        ];
    }
}
