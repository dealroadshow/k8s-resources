<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * CustomResourceConversion describes how to convert different versions of a CR.
 */
class CustomResourceConversion implements JsonSerializable
{
    /**
     * strategy specifies how custom resources are converted between versions. Allowed
     * values are: - `None`: The converter only change the apiVersion and would not
     * touch any other field in the custom resource. - `Webhook`: API Server will call
     * to an external webhook to do the conversion. Additional information
     *   is needed for this option. This requires spec.preserveUnknownFields to be
     * false, and spec.conversion.webhook to be set.
     */
    private string $strategy;

    /**
     * webhook describes how to call the conversion webhook. Required when `strategy`
     * is set to `Webhook`.
     */
    private WebhookConversion $webhook;

    public function __construct(string $strategy)
    {
        $this->strategy = $strategy;
        $this->webhook = new WebhookConversion();
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    public function setStrategy(string $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function webhook(): WebhookConversion
    {
        return $this->webhook;
    }

    public function jsonSerialize()
    {
        return [
            'strategy' => $this->strategy,
            'webhook' => $this->webhook,
        ];
    }
}
