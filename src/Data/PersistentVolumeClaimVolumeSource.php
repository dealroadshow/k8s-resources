<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PersistentVolumeClaimVolumeSource references the user's PVC in the same
 * namespace. This volume finds the bound PV and mounts that volume for the pod. A
 * PersistentVolumeClaimVolumeSource is, essentially, a wrapper around another type
 * of volume that is owned by someone else (the system).
 */
class PersistentVolumeClaimVolumeSource implements JsonSerializable
{
    /**
     * ClaimName is the name of a PersistentVolumeClaim in the same namespace as the
     * pod using this volume. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#persistentvolumeclaims
     */
    private string $claimName;

    /**
     * Will force the ReadOnly setting in VolumeMounts. Default false.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    public function __construct(string $claimName)
    {
        $this->claimName = $claimName;
    }

    public function getClaimName(): string
    {
        return $this->claimName;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function setClaimName(string $claimName): self
    {
        $this->claimName = $claimName;

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
            'claimName' => $this->claimName,
            'readOnly' => $this->readOnly,
        ];
    }
}
