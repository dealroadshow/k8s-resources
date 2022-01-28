<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a Persistent Disk resource in AWS.
 *
 * An AWS EBS disk must exist before mounting to a container. The disk must also be
 * in the same AWS zone as the kubelet. An AWS EBS disk can only be mounted as
 * read/write once. AWS EBS volumes support ownership management and SELinux
 * relabeling.
 */
class AWSElasticBlockStoreVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type of the volume that you want to mount. Tip: Ensure that the
     * filesystem type is supported by the host operating system. Examples: "ext4",
     * "xfs", "ntfs". Implicitly inferred to be "ext4" if unspecified. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#awselasticblockstore
     */
    private string|null $fsType = null;

    /**
     * The partition in the volume that you want to mount. If omitted, the default is
     * to mount by volume name. Examples: For volume /dev/sda1, you specify the
     * partition as "1". Similarly, the volume partition for /dev/sda is "0" (or you
     * can leave the property empty).
     */
    private int|null $partition = null;

    /**
     * Specify "true" to force and set the ReadOnly property in VolumeMounts to "true".
     * If omitted, the default is "false". More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#awselasticblockstore
     */
    private bool|null $readOnly = null;

    /**
     * Unique ID of the persistent disk resource in AWS (Amazon EBS volume). More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#awselasticblockstore
     */
    private string $volumeID;

    public function __construct(string $volumeID)
    {
        $this->volumeID = $volumeID;
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getPartition(): int|null
    {
        return $this->partition;
    }

    public function getReadOnly(): bool|null
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

    public function setPartition(int $partition): self
    {
        $this->partition = $partition;

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

    public function jsonSerialize(): array
    {
        return [
            'fsType' => $this->fsType,
            'partition' => $this->partition,
            'readOnly' => $this->readOnly,
            'volumeID' => $this->volumeID,
        ];
    }
}
