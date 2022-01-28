<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ConfigMapNodeConfigSource contains the information to reference a ConfigMap as a
 * config source for the Node.
 */
class ConfigMapNodeConfigSource implements JsonSerializable
{
    /**
     * KubeletConfigKey declares which key of the referenced ConfigMap corresponds to
     * the KubeletConfiguration structure This field is required in all cases.
     */
    private string $kubeletConfigKey;

    /**
     * Name is the metadata.name of the referenced ConfigMap. This field is required in
     * all cases.
     */
    private string $name;

    /**
     * Namespace is the metadata.namespace of the referenced ConfigMap. This field is
     * required in all cases.
     */
    private string $namespace;

    /**
     * ResourceVersion is the metadata.ResourceVersion of the referenced ConfigMap.
     * This field is forbidden in Node.Spec, and required in Node.Status.
     */
    private string|null $resourceVersion = null;

    /**
     * UID is the metadata.UID of the referenced ConfigMap. This field is forbidden in
     * Node.Spec, and required in Node.Status.
     */
    private string|null $uid = null;

    public function __construct(string $kubeletConfigKey, string $name, string $namespace)
    {
        $this->kubeletConfigKey = $kubeletConfigKey;
        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function getKubeletConfigKey(): string
    {
        return $this->kubeletConfigKey;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getResourceVersion(): string|null
    {
        return $this->resourceVersion;
    }

    public function getUid(): string|null
    {
        return $this->uid;
    }

    public function setKubeletConfigKey(string $kubeletConfigKey): self
    {
        $this->kubeletConfigKey = $kubeletConfigKey;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function setResourceVersion(string $resourceVersion): self
    {
        $this->resourceVersion = $resourceVersion;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'kubeletConfigKey' => $this->kubeletConfigKey,
            'name' => $this->name,
            'namespace' => $this->namespace,
            'resourceVersion' => $this->resourceVersion,
            'uid' => $this->uid,
        ];
    }
}
