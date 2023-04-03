<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ScaleIOPersistentVolumeSource represents a persistent ScaleIO volume
 */
class ScaleIOPersistentVolumeSource implements JsonSerializable
{
    /**
     * fsType is the filesystem type to mount. Must be a filesystem type supported by
     * the host operating system. Ex. "ext4", "xfs", "ntfs". Default is "xfs"
     */
    private string|null $fsType = null;

    /**
     * gateway is the host address of the ScaleIO API Gateway.
     */
    private string $gateway;

    /**
     * protectionDomain is the name of the ScaleIO Protection Domain for the configured
     * storage.
     */
    private string|null $protectionDomain = null;

    /**
     * readOnly defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts.
     */
    private bool|null $readOnly = null;

    /**
     * secretRef references to the secret for ScaleIO user and other sensitive
     * information. If this is not provided, Login operation will fail.
     */
    private SecretReference $secretRef;

    /**
     * sslEnabled is the flag to enable/disable SSL communication with Gateway, default
     * false
     */
    private bool|null $sslEnabled = null;

    /**
     * storageMode indicates whether the storage for a volume should be
     * ThickProvisioned or ThinProvisioned. Default is ThinProvisioned.
     */
    private string|null $storageMode = null;

    /**
     * storagePool is the ScaleIO Storage Pool associated with the protection domain.
     */
    private string|null $storagePool = null;

    /**
     * system is the name of the storage system as configured in ScaleIO.
     */
    private string $system;

    /**
     * volumeName is the name of a volume already created in the ScaleIO system that is
     * associated with this volume source.
     */
    private string|null $volumeName = null;

    public function __construct(string $gateway, string $system)
    {
        $this->gateway = $gateway;
        $this->secretRef = new SecretReference();
        $this->system = $system;
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getGateway(): string
    {
        return $this->gateway;
    }

    public function getProtectionDomain(): string|null
    {
        return $this->protectionDomain;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getSslEnabled(): bool|null
    {
        return $this->sslEnabled;
    }

    public function getStorageMode(): string|null
    {
        return $this->storageMode;
    }

    public function getStoragePool(): string|null
    {
        return $this->storagePool;
    }

    public function getSystem(): string
    {
        return $this->system;
    }

    public function getVolumeName(): string|null
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

    public function jsonSerialize(): array
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
