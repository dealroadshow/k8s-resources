<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * DeploymentStrategy describes how to replace existing pods with new ones.
 */
class DeploymentStrategy implements JsonSerializable
{
    /**
     * Rolling update config params. Present only if DeploymentStrategyType =
     * RollingUpdate.
     */
    private RollingUpdateDeployment $rollingUpdate;

    /**
     * Type of deployment. Can be "Recreate" or "RollingUpdate". Default is
     * RollingUpdate.
     *
     * @var string|null
     */
    private ?string $type = null;

    public function __construct()
    {
        $this->rollingUpdate = new RollingUpdateDeployment();
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function rollingUpdate(): RollingUpdateDeployment
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
