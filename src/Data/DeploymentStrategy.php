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
     */
    private string|null $type = null;

    public function __construct()
    {
        $this->rollingUpdate = new RollingUpdateDeployment();
    }

    public function getType(): string|null
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

    public function jsonSerialize(): array
    {
        return [
            'rollingUpdate' => $this->rollingUpdate,
            'type' => $this->type,
        ];
    }
}
