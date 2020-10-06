<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * HostAlias holds the mapping between IP and hostnames that will be injected as an
 * entry in the pod's hosts file.
 */
class HostAlias implements JsonSerializable
{
    /**
     * Hostnames for the above IP address.
     */
    private StringList $hostnames;

    /**
     * IP address of the host file entry.
     *
     * @var string|null
     */
    private ?string $ip = null;

    public function __construct()
    {
        $this->hostnames = new StringList();
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function hostnames(): StringList
    {
        return $this->hostnames;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'hostnames' => $this->hostnames,
            'ip' => $this->ip,
        ];
    }
}
