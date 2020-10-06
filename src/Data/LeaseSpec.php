<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\MicroTime;
use JsonSerializable;

/**
 * LeaseSpec is a specification of a Lease.
 */
class LeaseSpec implements JsonSerializable
{
    /**
     * acquireTime is a time when the current lease was acquired.
     *
     * @var MicroTime|null
     */
    private ?MicroTime $acquireTime = null;

    /**
     * holderIdentity contains the identity of the holder of a current lease.
     *
     * @var string|null
     */
    private ?string $holderIdentity = null;

    /**
     * leaseDurationSeconds is a duration that candidates for a lease need to wait to
     * force acquire it. This is measure against time of last observed RenewTime.
     *
     * @var int|null
     */
    private ?int $leaseDurationSeconds = null;

    /**
     * leaseTransitions is the number of transitions of a lease between holders.
     *
     * @var int|null
     */
    private ?int $leaseTransitions = null;

    /**
     * renewTime is a time when the current holder of a lease has last updated the
     * lease.
     *
     * @var MicroTime|null
     */
    private ?MicroTime $renewTime = null;

    public function __construct()
    {
    }

    /**
     * @return MicroTime|null
     */
    public function getAcquireTime(): ?MicroTime
    {
        return $this->acquireTime;
    }

    /**
     * @return string|null
     */
    public function getHolderIdentity(): ?string
    {
        return $this->holderIdentity;
    }

    /**
     * @return int|null
     */
    public function getLeaseDurationSeconds(): ?int
    {
        return $this->leaseDurationSeconds;
    }

    /**
     * @return int|null
     */
    public function getLeaseTransitions(): ?int
    {
        return $this->leaseTransitions;
    }

    /**
     * @return MicroTime|null
     */
    public function getRenewTime(): ?MicroTime
    {
        return $this->renewTime;
    }

    public function setAcquireTime(MicroTime $acquireTime): self
    {
        $this->acquireTime = $acquireTime;

        return $this;
    }

    public function setHolderIdentity(string $holderIdentity): self
    {
        $this->holderIdentity = $holderIdentity;

        return $this;
    }

    public function setLeaseDurationSeconds(int $leaseDurationSeconds): self
    {
        $this->leaseDurationSeconds = $leaseDurationSeconds;

        return $this;
    }

    public function setLeaseTransitions(int $leaseTransitions): self
    {
        $this->leaseTransitions = $leaseTransitions;

        return $this;
    }

    public function setRenewTime(MicroTime $renewTime): self
    {
        $this->renewTime = $renewTime;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'acquireTime' => $this->acquireTime,
            'holderIdentity' => $this->holderIdentity,
            'leaseDurationSeconds' => $this->leaseDurationSeconds,
            'leaseTransitions' => $this->leaseTransitions,
            'renewTime' => $this->renewTime,
        ];
    }
}
