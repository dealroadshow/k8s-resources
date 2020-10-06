<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ScaleIOPersistentVolumeSource represents a persistent ScaleIO volume
 */
class ScaleIOPersistentVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type to mount. Must be a filesystem type supported by the host
     * operating system. Ex. "ext4", "xfs", "ntfs". Default is "xfs"
     *
     * @var string|null
     */
    private ?string $fsType = null;

    /**
     * The host address of the ScaleIO API Gateway.
     */
    private string $gateway;

    /**
     * The name of the ScaleIO Protection Domain for the configured storage.
     *
     * @var string|null
     */
    private ?string $protectionDomain = null;

    /**
     * Defaults to false (read/write). ReadOnly here will force the ReadOnly setting in
     * VolumeMounts.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    /**
     * SecretRef references to the secret for ScaleIO user and other sensitive
     * information. If this is not provided, Login operation will fail.
     */
    private SecretReference $secretRef;

    /**
     * Flag to enable/disable SSL communication with Gateway, default false
     *
     * @var bool|null
     */
    private ?bool $sslEnabled = null;

    /**
     * Indicates whether the storage for a volume should be ThickProvisioned or
     * ThinProvisioned. Default is ThinProvisioned.
     *
     * @var string|null
     */
    private ?string $storageMode = null;

    /**
     * The ScaleIO Storage Pool associated with the protection domain.
     *
     * @var string|null
     */
    private ?string $storagePool = null;

    /**
     * The name of the storage system as configured in ScaleIO.
     */
    private string $system;

    /**
     * The name of a volume already created in the ScaleIO system that is associated
     * with this volume source.
     *
     * @var string|null
     */
    private ?string $volumeName = null;

    public function __construct(string $gateway, string $system)
    {
        $this->gateway = $gateway;
        $this->secretRef = new SecretReference();
        $this->system = $system;
    }

    /**
     * @return string|null
     */
    public function getFsType(): ?string
    {
        return $this->fsType;
    }

    public function getGateway(): string
    {
        return $this->gateway;
    }

    /**
     * @return string|null
     */
    public function getProtectionDomain(): ?string
    {
        return $this->protectionDomain;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    /**
     * @return bool|null
     */
    public function getSslEnabled(): ?bool
    {
        return $this->sslEnabled;
    }

    /**
     * @return string|null
     */
    public function getStorageMode(): ?string
    {
        return $this->storageMode;
    }

    /**
     * @return string|null
     */
    public function getStoragePool(): ?string
    {
        return $this->storagePool;
    }

    public function getSystem(): string
    {
        return $this->system;
    }

    /**
     * @return string|null
     */
    public function getVolumeName(): ?string
    {
        return $this->volumeName;
    }

    public function secretRef(): SecretReference
    {
        return $this->secretRef;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setGateway(string $gateway): self
    {
        $this->gateway = $gateway;

        return $this;
    }

    public function setProtectionDomain(string $protectionDomain): self
    {
        $this->protectionDomain = $protectionDomain;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setSslEnabled(bool $sslEnabled): self
    {
        $this->sslEnabled = $sslEnabled;

        return $this;
    }

    public function setStorageMode(string $storageMode): self
    {
        $this->storageMode = $storageMode;

        return $this;
    }

    public function setStoragePool(string $storagePool): self
    {
        $this->storagePool = $storagePool;

        return $this;
    }

    public function setSystem(string $system): self
    {
        $this->system = $system;

        return $this;
    }

    public function setVolumeName(string $volumeName): self
    {
        $this->volumeName = $volumeName;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'fsType' => $this->fsType,
            'gateway' => $this->gateway,
            'protectionDomain' => $this->protectionDomain,
            'readOnly' => $this->readOnly,
            'secretRef' => $this->secretRef,
            'sslEnabled' => $this->sslEnabled,
            'storageMode' => $this->storageMode,
            'storagePool' => $this->storagePool,
            'system' => $this->system,
            'volumeName' => $this->volumeName,
        ];
    }
}
