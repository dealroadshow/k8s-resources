<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * IngressTLS describes the transport layer security associated with an Ingress.
 */
class IngressTLS implements JsonSerializable
{
    /**
     * Hosts are a list of hosts included in the TLS certificate. The values in this
     * list must match the name/s used in the tlsSecret. Defaults to the wildcard host
     * setting for the loadbalancer controller fulfilling this Ingress, if left
     * unspecified.
     */
    private StringList $hosts;

    /**
     * SecretName is the name of the secret used to terminate SSL traffic on 443. Field
     * is left optional to allow SSL routing based on SNI hostname alone. If the SNI
     * host in a listener conflicts with the "Host" header field used by an
     * IngressRule, the SNI host is used for termination and value of the Host header
     * is used for routing.
     */
    private string|null $secretName = null;

    public function __construct()
    {
        $this->hosts = new StringList();
    }

    public function getSecretName(): string|null
    {
        return $this->secretName;
    }

    public function hosts(): StringList
    {
        return $this->hosts;
    }

    public function setSecretName(string $secretName): self
    {
        $this->secretName = $secretName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'hosts' => $this->hosts,
            'secretName' => $this->secretName,
        ];
    }
}
