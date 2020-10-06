<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EnvVarSource represents a source for the value of an EnvVar.
 */
class EnvVarSource implements JsonSerializable
{
    /**
     * Selects a key of a ConfigMap.
     *
     * @var ConfigMapKeySelector|null
     */
    private ?ConfigMapKeySelector $configMapKeyRef = null;

    /**
     * Selects a field of the pod: supports metadata.name, metadata.namespace,
     * metadata.labels, metadata.annotations, spec.nodeName, spec.serviceAccountName,
     * status.hostIP, status.podIP.
     *
     * @var ObjectFieldSelector|null
     */
    private ?ObjectFieldSelector $fieldRef = null;

    /**
     * Selects a resource of the container: only resources limits and requests
     * (limits.cpu, limits.memory, limits.ephemeral-storage, requests.cpu,
     * requests.memory and requests.ephemeral-storage) are currently supported.
     *
     * @var ResourceFieldSelector|null
     */
    private ?ResourceFieldSelector $resourceFieldRef = null;

    /**
     * Selects a key of a secret in the pod's namespace
     *
     * @var SecretKeySelector|null
     */
    private ?SecretKeySelector $secretKeyRef = null;

    public function __construct()
    {
    }

    /**
     * @return ConfigMapKeySelector|null
     */
    public function getConfigMapKeyRef(): ?ConfigMapKeySelector
    {
        return $this->configMapKeyRef;
    }

    /**
     * @return ObjectFieldSelector|null
     */
    public function getFieldRef(): ?ObjectFieldSelector
    {
        return $this->fieldRef;
    }

    /**
     * @return ResourceFieldSelector|null
     */
    public function getResourceFieldRef(): ?ResourceFieldSelector
    {
        return $this->resourceFieldRef;
    }

    /**
     * @return SecretKeySelector|null
     */
    public function getSecretKeyRef(): ?SecretKeySelector
    {
        return $this->secretKeyRef;
    }

    public function setConfigMapKeyRef(ConfigMapKeySelector $configMapKeyRef): self
    {
        $this->configMapKeyRef = $configMapKeyRef;

        return $this;
    }

    public function setFieldRef(ObjectFieldSelector $fieldRef): self
    {
        $this->fieldRef = $fieldRef;

        return $this;
    }

    public function setResourceFieldRef(ResourceFieldSelector $resourceFieldRef): self
    {
        $this->resourceFieldRef = $resourceFieldRef;

        return $this;
    }

    public function setSecretKeyRef(SecretKeySelector $secretKeyRef): self
    {
        $this->secretKeyRef = $secretKeyRef;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'configMapKeyRef' => $this->configMapKeyRef,
            'fieldRef' => $this->fieldRef,
            'resourceFieldRef' => $this->resourceFieldRef,
            'secretKeyRef' => $this->secretKeyRef,
        ];
    }
}
