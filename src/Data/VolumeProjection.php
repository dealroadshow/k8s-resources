<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Projection that may be projected along with other supported volume types
 */
class VolumeProjection implements JsonSerializable
{
    /**
     * information about the configMap data to project
     */
    private ConfigMapProjection $configMap;

    /**
     * information about the downwardAPI data to project
     */
    private DownwardAPIProjection $downwardAPI;

    /**
     * information about the secret data to project
     */
    private SecretProjection $secret;

    /**
     * information about the serviceAccountToken data to project
     *
     * @var ServiceAccountTokenProjection|null
     */
    private ?ServiceAccountTokenProjection $serviceAccountToken = null;

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

    /**
     * @return ServiceAccountTokenProjection|null
     */
    public function getServiceAccountToken(): ?ServiceAccountTokenProjection
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

    public function jsonSerialize()
    {
        return [
            'configMap' => $this->configMap,
            'downwardAPI' => $this->downwardAPI,
            'secret' => $this->secret,
            'serviceAccountToken' => $this->serviceAccountToken,
        ];
    }
}
