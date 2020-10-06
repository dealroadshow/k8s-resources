<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * NodeConfigSource specifies a source of node configuration. Exactly one subfield
 * (excluding metadata) must be non-nil.
 */
class NodeConfigSource implements JsonSerializable
{
    /**
     * ConfigMap is a reference to a Node's ConfigMap
     *
     * @var ConfigMapNodeConfigSource|null
     */
    private ?ConfigMapNodeConfigSource $configMap = null;

    public function __construct()
    {
    }

    /**
     * @return ConfigMapNodeConfigSource|null
     */
    public function getConfigMap(): ?ConfigMapNodeConfigSource
    {
        return $this->configMap;
    }

    public function setConfigMap(ConfigMapNodeConfigSource $configMap): self
    {
        $this->configMap = $configMap;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'configMap' => $this->configMap,
        ];
    }
}
