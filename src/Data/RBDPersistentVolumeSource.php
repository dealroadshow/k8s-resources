<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * Represents a Rados Block Device mount that lasts the lifetime of a pod. RBD
 * volumes support ownership management and SELinux relabeling.
 */
class RBDPersistentVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type of the volume that you want to mount. Tip: Ensure that the
     * filesystem type is supported by the host operating system. Examples: "ext4",
     * "xfs", "ntfs". Implicitly inferred to be "ext4" if unspecified. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#rbd
     *
     * @var string|null
     */
    private ?string $fsType = null;

    /**
     * The rados image name. More info:
     * https://examples.k8s.io/volumes/rbd/README.md#how-to-use-it
     */
    private string $image;

    /**
     * Keyring is the path to key ring for RBDUser. Default is /etc/ceph/keyring. More
     * info: https://examples.k8s.io/volumes/rbd/README.md#how-to-use-it
     *
     * @var string|null
     */
    private ?string $keyring = null;

    /**
     * A collection of Ceph monitors. More info:
     * https://examples.k8s.io/volumes/rbd/README.md#how-to-use-it
     */
    private StringList $monitors;

    /**
     * The rados pool name. Default is rbd. More info:
     * https://examples.k8s.io/volumes/rbd/README.md#how-to-use-it
     *
     * @var string|null
     */
    private ?string $pool = null;

    /**
     * ReadOnly here will force the ReadOnly setting in VolumeMounts. Defaults to
     * false. More info: https://examples.k8s.io/volumes/rbd/README.md#how-to-use-it
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    /**
     * SecretRef is name of the authentication secret for RBDUser. If provided
     * overrides keyring. Default is nil. More info:
     * https://examples.k8s.io/volumes/rbd/README.md#how-to-use-it
     */
    private SecretReference $secretRef;

    /**
     * The rados user name. Default is admin. More info:
     * https://examples.k8s.io/volumes/rbd/README.md#how-to-use-it
     *
     * @var string|null
     */
    private ?string $user = null;

    public function __construct(string $image)
    {
        $this->image = $image;
        $this->monitors = new StringList();
        $this->secretRef = new SecretReference();
    }

    /**
     * @return string|null
     */
    public function getFsType(): ?string
    {
        return $this->fsType;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getKeyring(): ?string
    {
        return $this->keyring;
    }

    /**
     * @return string|null
     */
    public function getPool(): ?string
    {
        return $this->pool;
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

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setKeyring(string $keyring): self
    {
        $this->keyring = $keyring;

        return $this;
    }

    public function setPool(string $pool): self
    {
        $this->pool = $pool;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

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
            'fsType' => $this->fsType,
            'image' => $this->image,
            'keyring' => $this->keyring,
            'monitors' => $this->monitors,
            'pool' => $this->pool,
            'readOnly' => $this->readOnly,
            'secretRef' => $this->secretRef,
            'user' => $this->user,
        ];
    }
}
