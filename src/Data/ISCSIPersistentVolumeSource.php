<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * ISCSIPersistentVolumeSource represents an ISCSI disk. ISCSI volumes can only be
 * mounted as read/write once. ISCSI volumes support ownership management and
 * SELinux relabeling.
 */
class ISCSIPersistentVolumeSource implements JsonSerializable
{
    /**
     * whether support iSCSI Discovery CHAP authentication
     *
     * @var bool|null
     */
    private ?bool $chapAuthDiscovery = null;

    /**
     * whether support iSCSI Session CHAP authentication
     *
     * @var bool|null
     */
    private ?bool $chapAuthSession = null;

    /**
     * Filesystem type of the volume that you want to mount. Tip: Ensure that the
     * filesystem type is supported by the host operating system. Examples: "ext4",
     * "xfs", "ntfs". Implicitly inferred to be "ext4" if unspecified. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#iscsi
     *
     * @var string|null
     */
    private ?string $fsType = null;

    /**
     * Custom iSCSI Initiator Name. If initiatorName is specified with iscsiInterface
     * simultaneously, new iSCSI interface <target portal>:<volume name> will be
     * created for the connection.
     *
     * @var string|null
     */
    private ?string $initiatorName = null;

    /**
     * Target iSCSI Qualified Name.
     */
    private string $iqn;

    /**
     * iSCSI Interface Name that uses an iSCSI transport. Defaults to 'default' (tcp).
     *
     * @var string|null
     */
    private ?string $iscsiInterface = null;

    /**
     * iSCSI Target Lun number.
     */
    private int $lun;

    /**
     * iSCSI Target Portal List. The Portal is either an IP or ip_addr:port if the port
     * is other than default (typically TCP ports 860 and 3260).
     */
    private StringList $portals;

    /**
     * ReadOnly here will force the ReadOnly setting in VolumeMounts. Defaults to
     * false.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    /**
     * CHAP Secret for iSCSI target and initiator authentication
     */
    private SecretReference $secretRef;

    /**
     * iSCSI Target Portal. The Portal is either an IP or ip_addr:port if the port is
     * other than default (typically TCP ports 860 and 3260).
     */
    private string $targetPortal;

    public function __construct(string $iqn, int $lun, string $targetPortal)
    {
        $this->iqn = $iqn;
        $this->lun = $lun;
        $this->portals = new StringList();
        $this->secretRef = new SecretReference();
        $this->targetPortal = $targetPortal;
    }

    /**
     * @return bool|null
     */
    public function getChapAuthDiscovery(): ?bool
    {
        return $this->chapAuthDiscovery;
    }

    /**
     * @return bool|null
     */
    public function getChapAuthSession(): ?bool
    {
        return $this->chapAuthSession;
    }

    /**
     * @return string|null
     */
    public function getFsType(): ?string
    {
        return $this->fsType;
    }

    /**
     * @return string|null
     */
    public function getInitiatorName(): ?string
    {
        return $this->initiatorName;
    }

    public function getIqn(): string
    {
        return $this->iqn;
    }

    /**
     * @return string|null
     */
    public function getIscsiInterface(): ?string
    {
        return $this->iscsiInterface;
    }

    public function getLun(): int
    {
        return $this->lun;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function getTargetPortal(): string
    {
        return $this->targetPortal;
    }

    public function portals(): StringList
    {
        return $this->portals;
    }

    public function secretRef(): SecretReference
    {
        return $this->secretRef;
    }

    public function setChapAuthDiscovery(bool $chapAuthDiscovery): self
    {
        $this->chapAuthDiscovery = $chapAuthDiscovery;

        return $this;
    }

    public function setChapAuthSession(bool $chapAuthSession): self
    {
        $this->chapAuthSession = $chapAuthSession;

        return $this;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setInitiatorName(string $initiatorName): self
    {
        $this->initiatorName = $initiatorName;

        return $this;
    }

    public function setIqn(string $iqn): self
    {
        $this->iqn = $iqn;

        return $this;
    }

    public function setIscsiInterface(string $iscsiInterface): self
    {
        $this->iscsiInterface = $iscsiInterface;

        return $this;
    }

    public function setLun(int $lun): self
    {
        $this->lun = $lun;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setTargetPortal(string $targetPortal): self
    {
        $this->targetPortal = $targetPortal;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'chapAuthDiscovery' => $this->chapAuthDiscovery,
            'chapAuthSession' => $this->chapAuthSession,
            'fsType' => $this->fsType,
            'initiatorName' => $this->initiatorName,
            'iqn' => $this->iqn,
            'iscsiInterface' => $this->iscsiInterface,
            'lun' => $this->lun,
            'portals' => $this->portals,
            'readOnly' => $this->readOnly,
            'secretRef' => $this->secretRef,
            'targetPortal' => $this->targetPortal,
        ];
    }
}
