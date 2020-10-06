<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * AzureFile represents an Azure File Service mount on the host and bind mount to
 * the pod.
 */
class AzureFileVolumeSource implements JsonSerializable
{
    /**
     * Defaults to false (read/write). ReadOnly here will force the ReadOnly setting in
     * VolumeMounts.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    /**
     * the name of secret that contains Azure Storage Account Name and Key
     */
    private string $secretName;

    /**
     * Share Name
     */
    private string $shareName;

    public function __construct(string $secretName, string $shareName)
    {
        $this->secretName = $secretName;
        $this->shareName = $shareName;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function getSecretName(): string
    {
        return $this->secretName;
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

    public function setShareName(string $shareName): self
    {
        $this->shareName = $shareName;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'readOnly' => $this->readOnly,
            'secretName' => $this->secretName,
            'shareName' => $this->shareName,
        ];
    }
}
