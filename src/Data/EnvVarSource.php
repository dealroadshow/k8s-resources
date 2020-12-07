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
     */
    private ConfigMapKeySelector|null $configMapKeyRef = null;

    /**
     * Selects a field of the pod: supports metadata.name, metadata.namespace,
     * metadata.labels, metadata.annotations, spec.nodeName, spec.serviceAccountName,
     * status.hostIP, status.podIP.
     */
    private ObjectFieldSelector|null $fieldRef = null;

    /**
     * Selects a resource of the container: only resources limits and requests
     * (limits.cpu, limits.memory, limits.ephemeral-storage, requests.cpu,
     * requests.memory and requests.ephemeral-storage) are currently supported.
     */
    private ResourceFieldSelector|null $resourceFieldRef = null;

    /**
     * Selects a key of a secret in the pod's namespace
     */
    private SecretKeySelector|null $secretKeyRef = null;

    public function __construct()
    {
    }

    public function getConfigMapKeyRef(): ConfigMapKeySelector|null
    {
        return $this->configMapKeyRef;
    }

    public function getFieldRef(): ObjectFieldSelector|null
    {
        return $this->fieldRef;
    }

    public function getResourceFieldRef(): ResourceFieldSelector|null
    {
        return $this->resourceFieldRef;
    }

    public function getSecretKeyRef(): SecretKeySelector|null
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

    public function jsonSerialize(): array
    {
        return [
            'configMapKeyRef' => $this->configMapKeyRef,
            'fieldRef' => $this->fieldRef,
            'resourceFieldRef' => $this->resourceFieldRef,
            'secretKeyRef' => $this->secretKeyRef,
        ];
    }
}
