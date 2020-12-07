<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringMap;
use JsonSerializable;

/**
 * FlexPersistentVolumeSource represents a generic persistent volume resource that
 * is provisioned/attached using an exec based plugin.
 */
class FlexPersistentVolumeSource implements JsonSerializable
{
    /**
     * Driver is the name of the driver to use for this volume.
     */
    private string $driver;

    /**
     * Filesystem type to mount. Must be a filesystem type supported by the host
     * operating system. Ex. "ext4", "xfs", "ntfs". The default filesystem depends on
     * FlexVolume script.
     */
    private string|null $fsType = null;

    /**
     * Optional: Extra command options if any.
     */
    private StringMap $options;

    /**
     * Optional: Defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts.
     */
    private bool|null $readOnly = null;

    /**
     * Optional: SecretRef is reference to the secret object containing sensitive
     * information to pass to the plugin scripts. This may be empty if no secret object
     * is specified. If the secret object contains more than one secret, all secrets
     * are passed to the plugin scripts.
     */
    private SecretReference $secretRef;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
        $this->options = new StringMap();
        $this->secretRef = new SecretReference();
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

    public function options(): StringMap
    {
        return $this->options;
    }

    public function secretRef(): SecretReference
    {
        return $this->secretRef;
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

    public function jsonSerialize(): array
    {
        return [
            'driver' => $this->driver,
            'fsType' => $this->fsType,
            'options' => $this->options,
            'readOnly' => $this->readOnly,
            'secretRef' => $this->secretRef,
        ];
    }
}
