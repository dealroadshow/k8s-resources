<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\IngressRuleList;
use Dealroadshow\K8S\Data\Collection\IngressTLSList;
use JsonSerializable;

/**
 * IngressSpec describes the Ingress the user wishes to exist.
 */
class IngressSpec implements JsonSerializable
{
    /**
     * A default backend capable of servicing requests that don't match any rule. At
     * least one of 'backend' or 'rules' must be specified. This field is optional to
     * allow the loadbalancer controller or defaulting logic to specify a global
     * default.
     */
    private IngressBackend|null $backend = null;

    /**
     * A list of host rules used to configure the Ingress. If unspecified, or no rule
     * matches, all traffic is sent to the default backend.
     */
    private IngressRuleList $rules;

    /**
     * TLS configuration. Currently the Ingress only supports a single TLS port, 443.
     * If multiple members of this list specify different hosts, they will be
     * multiplexed on the same port according to the hostname specified through the SNI
     * TLS extension, if the ingress controller fulfilling the ingress supports SNI.
     */
    private IngressTLSList $tls;

    public function __construct()
    {
        $this->rules = new IngressRuleList();
        $this->tls = new IngressTLSList();
    }

    public function getBackend(): IngressBackend|null
    {
        return $this->backend;
    }

    public function rules(): IngressRuleList
    {
        return $this->rules;
    }

    public function setBackend(IngressBackend $backend): self
    {
        $this->backend = $backend;

        return $this;
    }

    public function tls(): IngressTLSList
    {
        return $this->tls;
    }

    public function jsonSerialize(): array
    {
        return [
            'backend' => $this->backend,
            'rules' => $this->rules,
            'tls' => $this->tls,
        ];
    }
}
