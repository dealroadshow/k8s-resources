<?php 

namespace Dealroadshow\K8S\API\Discovery;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\EndpointList;
use Dealroadshow\K8S\Data\Collection\EndpointPortList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * EndpointSlice represents a subset of the endpoints that implement a service. For
 * a given service there may be multiple EndpointSlice objects, selected by labels,
 * which must be joined to produce the full set of endpoints.
 */
class EndpointSlice implements APIResourceInterface
{
    const API_VERSION = 'discovery.k8s.io/v1beta1';
    const KIND = 'EndpointSlice';

    /**
     * addressType specifies the type of address carried by this EndpointSlice. All
     * addresses in this slice must be the same type. This field is immutable after
     * creation. The following address types are currently supported: * IPv4:
     * Represents an IPv4 Address. * IPv6: Represents an IPv6 Address. * FQDN:
     * Represents a Fully Qualified Domain Name.
     */
    private string $addressType;

    /**
     * endpoints is a list of unique endpoints in this slice. Each slice may include a
     * maximum of 1000 endpoints.
     */
    private EndpointList $endpoints;

    /**
     * Standard object's metadata.
     */
    private ObjectMeta $metadata;

    /**
     * ports specifies the list of network ports exposed by each endpoint in this
     * slice. Each port must have a unique name. When ports is empty, it indicates that
     * there are no defined ports. When a port is defined with a nil port value, it
     * indicates "all ports". Each slice may include a maximum of 100 ports.
     */
    private EndpointPortList $ports;

    public function __construct(string $addressType)
    {
        $this->addressType = $addressType;
        $this->endpoints = new EndpointList();
        $this->metadata = new ObjectMeta();
        $this->ports = new EndpointPortList();
    }

    public function endpoints(): EndpointList
    {
        return $this->endpoints;
    }

    public function getAddressType(): string
    {
        return $this->addressType;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function ports(): EndpointPortList
    {
        return $this->ports;
    }

    public function setAddressType(string $addressType): self
    {
        $this->addressType = $addressType;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'addressType' => $this->addressType,
            'endpoints' => $this->endpoints,
            'metadata' => $this->metadata,
            'ports' => $this->ports,
        ];
    }
}
