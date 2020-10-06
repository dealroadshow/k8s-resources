<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a vSphere volume resource.
 */
class VsphereVirtualDiskVolumeSource implements JsonSerializable
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
     * Storage Policy Based Management (SPBM) profile ID associated with the
     * StoragePolicyName.
     *
     * @var string|null
     */
    private ?string $storagePolicyID = null;

    /**
     * Storage Policy Based Management (SPBM) profile name.
     *
     * @var string|null
     */
    private ?string $storagePolicyName = null;

    /**
     * Path that identifies vSphere volume vmdk
     */
    private string $volumePath;

    public function __construct(string $volumePath)
    {
        $this->volumePath = $volumePath;
    }

    /**
     * @return string|null
     */
    public function getFsType(): ?string
    {
        return $this->fsType;
    }

    /**
     * @return string|null
     */
    public function getStoragePolicyID(): ?string
    {
        return $this->storagePolicyID;
    }

    /**
     * @return string|null
     */
    public function getStoragePolicyName(): ?string
    {
        return $this->storagePolicyName;
    }

    public function getVolumePath(): string
    {
        return $this->volumePath;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setStoragePolicyID(string $storagePolicyID): self
    {
        $this->storagePolicyID = $storagePolicyID;

        return $this;
    }

    public function setStoragePolicyName(string $storagePolicyName): self
    {
        $this->storagePolicyName = $storagePolicyName;

        return $this;
    }

    public function setVolumePath(string $volumePath): self
    {
        $this->volumePath = $volumePath;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'fsType' => $this->fsType,
            'storagePolicyID' => $this->storagePolicyID,
            'storagePolicyName' => $this->storagePolicyName,
            'volumePath' => $this->volumePath,
        ];
    }
}
