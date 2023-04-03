<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringMap;
use JsonSerializable;

/**
 * Represents a source location of a volume to mount, managed by an external CSI
 * driver
 */
class CSIVolumeSource implements JsonSerializable
{
    /**
     * driver is the name of the CSI driver that handles this volume. Consult with your
     * admin for the correct name as registered in the cluster.
     */
    private string $driver;

    /**
     * fsType to mount. Ex. "ext4", "xfs", "ntfs". If not provided, the empty value is
     * passed to the associated CSI driver which will determine the default filesystem
     * to apply.
     */
    private string|null $fsType = null;

    /**
     * nodePublishSecretRef is a reference to the secret object containing sensitive
     * information to pass to the CSI driver to complete the CSI NodePublishVolume and
     * NodeUnpublishVolume calls. This field is optional, and  may be empty if no
     * secret is required. If the secret object contains more than one secret, all
     * secret references are passed.
     */
    private LocalObjectReference $nodePublishSecretRef;

    /**
     * readOnly specifies a read-only configuration for the volume. Defaults to false
     * (read/write).
     */
    private bool|null $readOnly = null;

    /**
     * volumeAttributes stores driver-specific properties that are passed to the CSI
     * driver. Consult your driver's documentation for supported values.
     */
    private StringMap $volumeAttributes;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
        $this->nodePublishSecretRef = new LocalObjectReference();
        $this->volumeAttributes = new StringMap();
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function nodePublishSecretRef(): LocalObjectReference
    {
        return $this->nodePublishSecretRef;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
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

    public function volumeAttributes(): StringMap
    {
        return $this->volumeAttributes;
    }

    public function jsonSerialize(): array
    {
        return [
            'driver' => $this->driver,
            'fsType' => $this->fsType,
            'nodePublishSecretRef' => $this->nodePublishSecretRef,
            'readOnly' => $this->readOnly,
            'volumeAttributes' => $this->volumeAttributes,
        ];
    }
}
