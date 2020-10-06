<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a Photon Controller persistent disk resource.
 */
class PhotonPersistentDiskVolumeSource implements JsonSerializable
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
     * ID that identifies Photon Controller persistent disk
     */
    private string $pdID;

    public function __construct(string $pdID)
    {
        $this->pdID = $pdID;
    }

    /**
     * @return string|null
     */
    public function getFsType(): ?string
    {
        return $this->fsType;
    }

    public function getPdID(): string
    {
        return $this->pdID;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setPdID(string $pdID): self
    {
        $this->pdID = $pdID;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'fsType' => $this->fsType,
            'pdID' => $this->pdID,
        ];
    }
}
