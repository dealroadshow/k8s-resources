<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ServicePort contains information on service's port.
 */
class ServicePort implements JsonSerializable
{
    /**
     * The application protocol for this port. This field follows standard Kubernetes
     * label syntax. Un-prefixed names are reserved for IANA standard service names (as
     * per RFC-6335 and http://www.iana.org/assignments/service-names). Non-standard
     * protocols should use prefixed names such as mycompany.com/my-custom-protocol.
     */
    private string|null $appProtocol = null;

    /**
     * The name of this port within the service. This must be a DNS_LABEL. All ports
     * within a ServiceSpec must have unique names. When considering the endpoints for
     * a Service, this must match the 'name' field in the EndpointPort. Optional if
     * only one ServicePort is defined on this service.
     */
    private string|null $name = null;

    /**
     * The port on each node on which this service is exposed when type is NodePort or
     * LoadBalancer.  Usually assigned by the system. If a value is specified,
     * in-range, and not in use it will be used, otherwise the operation will fail.  If
     * not specified, a port will be allocated if this Service requires one.  If this
     * field is specified when creating a Service which does not need it, creation will
     * fail. This field will be wiped when updating a Service to no longer need it
     * (e.g. changing type from NodePort to ClusterIP). More info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#type-nodeport
     */
    private int|null $nodePort = null;

    /**
     * The port that will be exposed by this service.
     */
    private int $port;

    /**
     * The IP protocol for this port. Supports "TCP", "UDP", and "SCTP". Default is
     * TCP.
     */
    private string|null $protocol = null;

    /**
     * Number or name of the port to access on the pods targeted by the service. Number
     * must be in the range 1 to 65535. Name must be an IANA_SVC_NAME. If this is a
     * string, it will be looked up as a named port in the target Pod's container
     * ports. If this is not specified, the value of the 'port' field is used (an
     * identity map). This field is ignored for services with clusterIP=None, and
     * should be omitted or set equal to the 'port' field. More info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#defining-a-service
     */
    private string|int|null $targetPort = null;

    public function __construct(int $port)
    {
        $this->port = $port;
    }

    public function getAppProtocol(): string|null
    {
        return $this->appProtocol;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getNodePort(): int|null
    {
        return $this->nodePort;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getProtocol(): string|null
    {
        return $this->protocol;
    }

    public function getTargetPort(): string|int|null
    {
        return $this->targetPort;
    }

    public function setAppProtocol(string $appProtocol): self
    {
        $this->appProtocol = $appProtocol;

        return $this;
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

    public function setTargetPort(string|int $targetPort): self
    {
        $this->targetPort = $targetPort;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'appProtocol' => $this->appProtocol,
            'name' => $this->name,
            'nodePort' => $this->nodePort,
            'port' => $this->port,
            'protocol' => $this->protocol,
            'targetPort' => $this->targetPort,
        ];
    }
}
