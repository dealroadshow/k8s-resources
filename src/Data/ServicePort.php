<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\IntOrString;
use JsonSerializable;

/**
 * ServicePort contains information on service's port.
 */
class ServicePort implements JsonSerializable
{
    /**
     * The name of this port within the service. This must be a DNS_LABEL. All ports
     * within a ServiceSpec must have unique names. When considering the endpoints for
     * a Service, this must match the 'name' field in the EndpointPort. Optional if
     * only one ServicePort is defined on this service.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * The port on each node on which this service is exposed when type=NodePort or
     * LoadBalancer. Usually assigned by the system. If specified, it will be allocated
     * to the service if unused or else creation of the service will fail. Default is
     * to auto-allocate a port if the ServiceType of this Service requires one. More
     * info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#type-nodeport
     *
     * @var int|null
     */
    private ?int $nodePort = null;

    /**
     * The port that will be exposed by this service.
     */
    private int $port;

    /**
     * The IP protocol for this port. Supports "TCP", "UDP", and "SCTP". Default is
     * TCP.
     *
     * @var string|null
     */
    private ?string $protocol = null;

    /**
     * Number or name of the port to access on the pods targeted by the service. Number
     * must be in the range 1 to 65535. Name must be an IANA_SVC_NAME. If this is a
     * string, it will be looked up as a named port in the target Pod's container
     * ports. If this is not specified, the value of the 'port' field is used (an
     * identity map). This field is ignored for services with clusterIP=None, and
     * should be omitted or set equal to the 'port' field. More info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#defining-a-service
     *
     * @var IntOrString|null
     */
    private ?IntOrString $targetPort = null;

    public function __construct(int $port)
    {
        $this->port = $port;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getNodePort(): ?int
    {
        return $this->nodePort;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string|null
     */
    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    /**
     * @return IntOrString|null
     */
    public function getTargetPort(): ?IntOrString
    {
        return $this->targetPort;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNodePort(int $nodePort): self
    {
        $this->nodePort = $nodePort;

        return $this;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function setTargetPort(IntOrString $targetPort): self
    {
        $this->targetPort = $targetPort;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'nodePort' => $this->nodePort,
            'port' => $this->port,
            'protocol' => $this->protocol,
            'targetPort' => $this->targetPort,
        ];
    }
}
