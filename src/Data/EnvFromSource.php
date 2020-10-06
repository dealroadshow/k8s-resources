<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EnvFromSource represents the source of a set of ConfigMaps
 */
class EnvFromSource implements JsonSerializable
{
    /**
     * The ConfigMap to select from
     */
    private ConfigMapEnvSource $configMapRef;

    /**
     * An optional identifier to prepend to each key in the ConfigMap. Must be a
     * C_IDENTIFIER.
     *
     * @var string|null
     */
    private ?string $prefix = null;

    /**
     * The Secret to select from
     */
    private SecretEnvSource $secretRef;

    public function __construct()
    {
        $this->configMapRef = new ConfigMapEnvSource();
        $this->secretRef = new SecretEnvSource();
    }

    public function configMapRef(): ConfigMapEnvSource
    {
        return $this->configMapRef;
    }

    /**
     * @return string|null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function secretRef(): SecretEnvSource
    {
        return $this->secretRef;
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'configMapRef' => $this->configMapRef,
            'prefix' => $this->prefix,
            'secretRef' => $this->secretRef,
        ];
    }
}
