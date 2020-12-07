<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * AuditSinkSpec holds the spec for the audit sink
 */
class AuditSinkSpec implements JsonSerializable
{
    /**
     * Policy defines the policy for selecting which events should be sent to the
     * webhook required
     */
    private Policy $policy;

    /**
     * Webhook to send events required
     */
    private Webhook $webhook;

    public function __construct(Policy $policy)
    {
        $this->policy = $policy;
        $this->webhook = new Webhook();
    }

    public function getPolicy(): Policy
    {
        return $this->policy;
    }

    public function setPolicy(Policy $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    public function webhook(): Webhook
    {
        return $this->webhook;
    }

    public function jsonSerialize(): array
    {
        return [
            'policy' => $this->policy,
            'webhook' => $this->webhook,
        ];
    }
}
