<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a Persistent Disk resource in Google Compute Engine.
 *
 * A GCE PD must exist before mounting to a container. The disk must also be in the
 * same GCE project and zone as the kubelet. A GCE PD can only be mounted as
 * read/write once or read-only many times. GCE PDs support ownership management
 * and SELinux relabeling.
 */
class GCEPersistentDiskVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type of the volume that you want to mount. Tip: Ensure that the
     * filesystem type is supported by the host operating system. Examples: "ext4",
     * "xfs", "ntfs". Implicitly inferred to be "ext4" if unspecified. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     */
    private string|null $fsType = null;

    /**
     * The partition in the volume that you want to mount. If omitted, the default is
     * to mount by volume name. Examples: For volume /dev/sda1, you specify the
     * partition as "1". Similarly, the volume partition for /dev/sda is "0" (or you
     * can leave the property empty). More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     */
    private int|null $partition = null;

    /**
     * Unique name of the PD resource in GCE. Used to identify the disk in GCE. More
     * info: https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     */
    private string $pdName;

    /**
     * ReadOnly here will force the ReadOnly setting in VolumeMounts. Defaults to
     * false. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     */
    private bool|null $readOnly = null;

    public function __construct(string $pdName)
    {
        $this->pdName = $pdName;
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getPartition(): int|null
    {
        return $this->partition;
    }

    public function getPdName(): string
    {
        return $this->pdName;
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

    public function setPartition(int $partition): self
    {
        $this->partition = $partition;

        return $this;
    }

    public function setPdName(string $pdName): self
    {
        $this->pdName = $pdName;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'fsType' => $this->fsType,
            'partition' => $this->partition,
            'pdName' => $this->pdName,
            'readOnly' => $this->readOnly,
        ];
    }
}
