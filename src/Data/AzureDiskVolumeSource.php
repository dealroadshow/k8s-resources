<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * AzureDisk represents an Azure Data Disk mount on the host and bind mount to the
 * pod.
 */
class AzureDiskVolumeSource implements JsonSerializable
{
    /**
     * Host Caching mode: None, Read Only, Read Write.
     *
     * @var string|null
     */
    private ?string $cachingMode = null;

    /**
     * The Name of the data disk in the blob storage
     */
    private string $diskName;

    /**
     * The URI the data disk in the blob storage
     */
    private string $diskURI;

    /**
     * Filesystem type to mount. Must be a filesystem type supported by the host
     * operating system. Ex. "ext4", "xfs", "ntfs". Implicitly inferred to be "ext4" if
     * unspecified.
     *
     * @var string|null
     */
    private ?string $fsType = null;

    /**
     * Expected values Shared: multiple blob disks per storage account  Dedicated:
     * single blob disk per storage account  Managed: azure managed data disk (only in
     * managed availability set). defaults to shared
     *
     * @var string|null
     */
    private ?string $kind = null;

    /**
     * Defaults to false (read/write). ReadOnly here will force the ReadOnly setting in
     * VolumeMounts.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    public function __construct(string $diskName, string $diskURI)
    {
        $this->diskName = $diskName;
        $this->diskURI = $diskURI;
    }

    /**
     * @return string|null
     */
    public function getCachingMode(): ?string
    {
        return $this->cachingMode;
    }

    public function getDiskName(): string
    {
        return $this->diskName;
    }

    public function getDiskURI(): string
    {
        return $this->diskURI;
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
    public function getKind(): ?string
    {
        return $this->kind;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function setCachingMode(string $cachingMode): self
    {
        $this->cachingMode = $cachingMode;

        return $this;
    }

    public function setDiskName(string $diskName): self
    {
        $this->diskName = $diskName;

        return $this;
    }

    public function setDiskURI(string $diskURI): self
    {
        $this->diskURI = $diskURI;

        return $this;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'cachingMode' => $this->cachingMode,
            'diskName' => $this->diskName,
            'diskURI' => $this->diskURI,
            'fsType' => $this->fsType,
            'kind' => $this->kind,
            'readOnly' => $this->readOnly,
        ];
    }
}
