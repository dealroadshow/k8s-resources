<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Projection that may be projected along with other supported volume types
 */
class VolumeProjection implements JsonSerializable
{
    /**
     * configMap information about the configMap data to project
     */
    private ConfigMapProjection $configMap;

    /**
     * downwardAPI information about the downwardAPI data to project
     */
    private DownwardAPIProjection $downwardAPI;

    /**
     * secret information about the secret data to project
     */
    private SecretProjection $secret;

    /**
     * serviceAccountToken is information about the serviceAccountToken data to project
     */
    private ServiceAccountTokenProjection|null $serviceAccountToken = null;

    public function __construct()
    {
        $this->configMap = new ConfigMapProjection();
        $this->downwardAPI = new DownwardAPIProjection();
        $this->secret = new SecretProjection();
    }

    public function configMap(): ConfigMapProjection
    {
        return $this->configMap;
    }

    public function downwardAPI(): DownwardAPIProjection
    {
        return $this->downwardAPI;
    }

    public function getServiceAccountToken(): ServiceAccountTokenProjection|null
    {
        return $this->serviceAccountToken;
    }

    public function secret(): SecretProjection
    {
        return $this->secret;
    }

    public function setServiceAccountToken(ServiceAccountTokenProjection $serviceAccountToken): self
    {
        $this->serviceAccountToken = $serviceAccountToken;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'configMap' => $this->configMap,
            'downwardAPI' => $this->downwardAPI,
            'secret' => $this->secret,
            'serviceAccountToken' => $this->serviceAccountToken,
        ];
    }
}
