<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Webhook holds the configuration of the webhook
 */
class Webhook implements JsonSerializable
{
    /**
     * ClientConfig holds the connection parameters for the webhook required
     */
    private WebhookClientConfig $clientConfig;

    /**
     * Throttle holds the options for throttling the webhook
     */
    private WebhookThrottleConfig $throttle;

    public function __construct()
    {
        $this->clientConfig = new WebhookClientConfig();
        $this->throttle = new WebhookThrottleConfig();
    }

    public function clientConfig(): WebhookClientConfig
    {
        return $this->clientConfig;
    }

    public function throttle(): WebhookThrottleConfig
    {
        return $this->throttle;
    }

    public function jsonSerialize(): array
    {
        return [
            'clientConfig' => $this->clientConfig,
            'throttle' => $this->throttle,
        ];
    }
}
