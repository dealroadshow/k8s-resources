<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * NodeConfigSource specifies a source of node configuration. Exactly one subfield
 * (excluding metadata) must be non-nil. This API is deprecated since 1.22
 */
class NodeConfigSource implements JsonSerializable
{
    /**
     * ConfigMap is a reference to a Node's ConfigMap
     */
    private ConfigMapNodeConfigSource|null $configMap = null;

    public function __construct()
    {
    }

    public function getConfigMap(): ConfigMapNodeConfigSource|null
    {
        return $this->configMap;
    }

    public function setConfigMap(ConfigMapNodeConfigSource $configMap): self
    {
        $this->configMap = $configMap;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'configMap' => $this->configMap,
        ];
    }
}
