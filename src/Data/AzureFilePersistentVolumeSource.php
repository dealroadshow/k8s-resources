<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * AzureFile represents an Azure File Service mount on the host and bind mount to
 * the pod.
 */
class AzureFilePersistentVolumeSource implements JsonSerializable
{
    /**
     * readOnly defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts.
     */
    private bool|null $readOnly = null;

    /**
     * secretName is the name of secret that contains Azure Storage Account Name and
     * Key
     */
    private string $secretName;

    /**
     * secretNamespace is the namespace of the secret that contains Azure Storage
     * Account Name and Key default is the same as the Pod
     */
    private string|null $secretNamespace = null;

    /**
     * shareName is the azure Share Name
     */
    private string $shareName;

    public function __construct(string $secretName, string $shareName)
    {
        $this->secretName = $secretName;
        $this->shareName = $shareName;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getSecretName(): string
    {
        return $this->secretName;
    }

    public function getSecretNamespace(): string|null
    {
        return $this->secretNamespace;
    }

    public function getShareName(): string
    {
        return $this->shareName;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setSecretName(string $secretName): self
    {
        $this->secretName = $secretName;

        return $this;
    }

    public function setSecretNamespace(string $secretNamespace): self
    {
        $this->secretNamespace = $secretNamespace;

        return $this;
    }

    public function setShareName(string $shareName): self
    {
        $this->shareName = $shareName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'readOnly' => $this->readOnly,
            'secretName' => $this->secretName,
            'secretNamespace' => $this->secretNamespace,
            'shareName' => $this->shareName,
        ];
    }
}
