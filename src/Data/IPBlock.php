<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * IPBlock describes a particular CIDR (Ex. "192.168.1.0/24","2001:db8::/64") that
 * is allowed to the pods matched by a NetworkPolicySpec's podSelector. The except
 * entry describes CIDRs that should not be included within this rule.
 */
class IPBlock implements JsonSerializable
{
    /**
     * CIDR is a string representing the IP Block Valid examples are "192.168.1.0/24"
     * or "2001:db8::/64"
     */
    private string $cidr;

    /**
     * Except is a slice of CIDRs that should not be included within an IP Block Valid
     * examples are "192.168.1.0/24" or "2001:db8::/64" Except values will be rejected
     * if they are outside the CIDR range
     */
    private StringList $except;

    public function __construct(string $cidr)
    {
        $this->cidr = $cidr;
        $this->except = new StringList();
    }

    public function except(): StringList
    {
        return $this->except;
    }

    public function getCidr(): string
    {
        return $this->cidr;
    }

    public function setCidr(string $cidr): self
    {
        $this->cidr = $cidr;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'cidr' => $this->cidr,
            'except' => $this->except,
        ];
    }
}
