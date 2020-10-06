<?php 

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
     * @var string|null
     */
    private ?string $type = null;

    public function __construct()
    {
        $this->rollingUpdate = new RollingUpdateDaemonSet();
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
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

    public function jsonSerialize()
    {
        return [
            'rollingUpdate' => $this->rollingUpdate,
            'type' => $this->type,
        ];
    }
}
