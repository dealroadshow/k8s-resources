<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SessionAffinityConfig represents the configurations of session affinity.
 */
class SessionAffinityConfig implements JsonSerializable
{
    /**
     * clientIP contains the configurations of Client IP based session affinity.
     */
    private ClientIPConfig $clientIP;

    public function __construct()
    {
        $this->clientIP = new ClientIPConfig();
    }

    public function clientIP(): ClientIPConfig
    {
        return $this->clientIP;
    }

    public function jsonSerialize()
    {
        return [
            'clientIP' => $this->clientIP,
        ];
    }
}
