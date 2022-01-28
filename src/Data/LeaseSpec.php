<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * LeaseSpec is a specification of a Lease.
 */
class LeaseSpec implements JsonSerializable
{
    /**
     * acquireTime is a time when the current lease was acquired.
     */
    private DateTimeInterface|null $acquireTime = null;

    /**
     * holderIdentity contains the identity of the holder of a current lease.
     */
    private string|null $holderIdentity = null;

    /**
     * leaseDurationSeconds is a duration that candidates for a lease need to wait to
     * force acquire it. This is measure against time of last observed RenewTime.
     */
    private int|null $leaseDurationSeconds = null;

    /**
     * leaseTransitions is the number of transitions of a lease between holders.
     */
    private int|null $leaseTransitions = null;

    /**
     * renewTime is a time when the current holder of a lease has last updated the
     * lease.
     */
    private DateTimeInterface|null $renewTime = null;

    public function __construct()
    {
    }

    public function getAcquireTime(): DateTimeInterface|null
    {
        return $this->acquireTime;
    }

    public function getHolderIdentity(): string|null
    {
        return $this->holderIdentity;
    }

    public function getLeaseDurationSeconds(): int|null
    {
        return $this->leaseDurationSeconds;
    }

    public function getLeaseTransitions(): int|null
    {
        return $this->leaseTransitions;
    }

    public function getRenewTime(): DateTimeInterface|null
    {
        return $this->renewTime;
    }

    public function setAcquireTime(DateTimeInterface $acquireTime): self
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

    public function setRenewTime(DateTimeInterface $renewTime): self
    {
        $this->renewTime = $renewTime;

        return $this;
    }

    public function jsonSerialize(): array
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
