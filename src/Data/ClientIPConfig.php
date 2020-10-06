<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ClientIPConfig represents the configurations of Client IP based session
 * affinity.
 */
class ClientIPConfig implements JsonSerializable
{
    /**
     * timeoutSeconds specifies the seconds of ClientIP type session sticky time. The
     * value must be >0 && <=86400(for 1 day) if ServiceAffinity == "ClientIP". Default
     * value is 10800(for 3 hours).
     *
     * @var int|null
     */
    private ?int $timeoutSeconds = null;

    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getTimeoutSeconds(): ?int
    {
        return $this->timeoutSeconds;
    }

    public function setTimeoutSeconds(int $timeoutSeconds): self
    {
        $this->timeoutSeconds = $timeoutSeconds;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'timeoutSeconds' => $this->timeoutSeconds,
        ];
    }
}
