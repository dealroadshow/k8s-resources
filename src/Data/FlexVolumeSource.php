<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringMap;
use JsonSerializable;

/**
 * FlexVolume represents a generic volume resource that is provisioned/attached
 * using an exec based plugin.
 */
class FlexVolumeSource implements JsonSerializable
{
    /**
     * Driver is the name of the driver to use for this volume.
     */
    private string $driver;

    /**
     * Filesystem type to mount. Must be a filesystem type supported by the host
     * operating system. Ex. "ext4", "xfs", "ntfs". The default filesystem depends on
     * FlexVolume script.
     *
     * @var string|null
     */
    private ?string $fsType = null;

    /**
     * Optional: Extra command options if any.
     */
    private StringMap $options;

    /**
     * Optional: Defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    /**
     * Optional: SecretRef is reference to the secret object containing sensitive
     * information to pass to the plugin scripts. This may be empty if no secret object
     * is specified. If the secret object contains more than one secret, all secrets
     * are passed to the plugin scripts.
     */
    private LocalObjectReference $secretRef;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
        $this->options = new StringMap();
        $this->secretRef = new LocalObjectReference();
    }

    public function getDriver(): string
    {
        return $this->driver;
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

    public function options(): StringMap
    {
        return $this->options;
    }

    public function secretRef(): LocalObjectReference
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

    public function jsonSerialize()
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
