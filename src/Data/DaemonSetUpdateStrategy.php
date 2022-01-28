<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * DaemonSetUpdateStrategy is a struct used to control the update strategy for a
 * DaemonSet.
 */
class DaemonSetUpdateStrategy implements JsonSerializable
{
    /**
     * Rolling update config params. Present only if type = "RollingUpdate".
     */
    private RollingUpdateDaemonSet $rollingUpdate;

    /**
     * Type of daemon set update. Can be "RollingUpdate" or "OnDelete". Default is
     * RollingUpdate.
     *
     * Possible enum values:
     *  - `"OnDelete"` Replace the old daemons only when it's killed
     *  - `"RollingUpdate"` Replace the old daemons by new ones using rolling update
     * i.e replace them on each node one after the other.
     */
    private string|null $type = null;

    public function __construct()
    {
        $this->rollingUpdate = new RollingUpdateDaemonSet();
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function rollingUpdate(): RollingUpdateDaemonSet
    {
        return $this->rollingUpdate;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'rollingUpdate' => $this->rollingUpdate,
            'type' => $this->type,
        ];
    }
}
