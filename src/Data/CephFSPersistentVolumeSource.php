<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * Represents a Ceph Filesystem mount that lasts the lifetime of a pod Cephfs
 * volumes do not support ownership management or SELinux relabeling.
 */
class CephFSPersistentVolumeSource implements JsonSerializable
{
    /**
     * Required: Monitors is a collection of Ceph monitors More info:
     * https://examples.k8s.io/volumes/cephfs/README.md#how-to-use-it
     */
    private StringList $monitors;

    /**
     * Optional: Used as the mounted root, rather than the full Ceph tree, default is /
     *
     * @var string|null
     */
    private ?string $path = null;

    /**
     * Optional: Defaults to false (read/write). ReadOnly here will force the ReadOnly
     * setting in VolumeMounts. More info:
     * https://examples.k8s.io/volumes/cephfs/README.md#how-to-use-it
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    /**
     * Optional: SecretFile is the path to key ring for User, default is
     * /etc/ceph/user.secret More info:
     * https://examples.k8s.io/volumes/cephfs/README.md#how-to-use-it
     *
     * @var string|null
     */
    private ?string $secretFile = null;

    /**
     * Optional: SecretRef is reference to the authentication secret for User, default
     * is empty. More info:
     * https://examples.k8s.io/volumes/cephfs/README.md#how-to-use-it
     */
    private SecretReference $secretRef;

    /**
     * Optional: User is the rados user name, default is admin More info:
     * https://examples.k8s.io/volumes/cephfs/README.md#how-to-use-it
     *
     * @var string|null
     */
    private ?string $user = null;

    public function __construct()
    {
        $this->monitors = new StringList();
        $this->secretRef = new SecretReference();
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    /**
     * @return string|null
     */
    public function getSecretFile(): ?string
    {
        return $this->secretFile;
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    public function monitors(): StringList
    {
        return $this->monitors;
    }

    public function secretRef(): SecretReference
    {
        return $this->secretRef;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setSecretFile(string $secretFile): self
    {
        $this->secretFile = $secretFile;

        return $this;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'monitors' => $this->monitors,
            'path' => $this->path,
            'readOnly' => $this->readOnly,
            'secretFile' => $this->secretFile,
            'secretRef' => $this->secretRef,
            'user' => $this->user,
        ];
    }
}
