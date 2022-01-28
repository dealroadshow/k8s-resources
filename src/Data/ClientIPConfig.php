<?php

declare(strict_types=1);

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
     */
    private int|null $timeoutSeconds = null;

    public function __construct()
    {
    }

    public function getTimeoutSeconds(): int|null
    {
        return $this->timeoutSeconds;
    }

    public function setTimeoutSeconds(int $timeoutSeconds): self
    {
        $this->timeoutSeconds = $timeoutSeconds;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'timeoutSeconds' => $this->timeoutSeconds,
        ];
    }
}
