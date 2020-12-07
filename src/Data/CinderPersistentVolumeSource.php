<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a cinder volume resource in Openstack. A Cinder volume must exist
 * before mounting to a container. The volume must also be in the same region as
 * the kubelet. Cinder volumes support ownership management and SELinux relabeling.
 */
class CinderPersistentVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type to mount. Must be a filesystem type supported by the host
     * operating system. Examples: "ext4", "xfs", "ntfs". Implicitly inferred to be
     * "ext4" if unspecified. More info:
     * https://examples.k8s.io/mysql-cinder-pd/README.md
     */
    private string|null $fsType = null;

    /**
     * Optional: Defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts. More info:
     * https://examples.k8s.io/mysql-cinder-pd/README.md
     */
    private bool|null $readOnly = null;

    /**
     * Optional: points to a secret object containing parameters used to connect to
     * OpenStack.
     */
    private SecretReference $secretRef;

    /**
     * volume id used to identify the volume in cinder. More info:
     * https://examples.k8s.io/mysql-cinder-pd/README.md
     */
    private string $volumeID;

    public function __construct(string $volumeID)
    {
        $this->secretRef = new SecretReference();
        $this->volumeID = $volumeID;
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getVolumeID(): string
    {
        return $this->volumeID;
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
            'readOnly' => $this->readOnly,
            'secretRef' => $this->secretRef,
            'volumeID' => $this->volumeID,
        ];
    }
}
