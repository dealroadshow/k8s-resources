<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * Represents a Fibre Channel volume. Fibre Channel volumes can only be mounted as
 * read/write once. Fibre Channel volumes support ownership management and SELinux
 * relabeling.
 */
class FCVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type to mount. Must be a filesystem type supported by the host
     * operating system. Ex. "ext4", "xfs", "ntfs". Implicitly inferred to be "ext4" if
     * unspecified.
     */
    private string|null $fsType = null;

    /**
     * Optional: FC target lun number
     */
    private int|null $lun = null;

    /**
     * Optional: Defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts.
     */
    private bool|null $readOnly = null;

    /**
     * Optional: FC target worldwide names (WWNs)
     */
    private StringList $targetWWNs;

    /**
     * Optional: FC volume world wide identifiers (wwids) Either wwids or combination
     * of targetWWNs and lun must be set, but not both simultaneously.
     */
    private StringList $wwids;

    public function __construct()
    {
        $this->targetWWNs = new StringList();
        $this->wwids = new StringList();
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getLun(): int|null
    {
        return $this->lun;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setLun(int $lun): self
    {
        $this->lun = $lun;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function targetWWNs(): StringList
    {
        return $this->targetWWNs;
    }

    public function wwids(): StringList
    {
        return $this->wwids;
    }

    public function jsonSerialize(): array
    {
        return [
            'fsType' => $this->fsType,
            'lun' => $this->lun,
            'readOnly' => $this->readOnly,
            'targetWWNs' => $this->targetWWNs,
            'wwids' => $this->wwids,
        ];
    }
}
