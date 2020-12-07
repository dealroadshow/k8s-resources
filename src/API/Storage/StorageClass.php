<?php 

namespace Dealroadshow\K8S\API\Storage;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\StringMap;
use Dealroadshow\K8S\Data\Collection\TopologySelectorTermList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * StorageClass describes the parameters for a class of storage for which
 * PersistentVolumes can be dynamically provisioned.
 *
 * StorageClasses are non-namespaced; the name of the storage class according to
 * etcd is in ObjectMeta.Name.
 */
class StorageClass implements APIResourceInterface
{
    const API_VERSION = 'storage.k8s.io/v1';
    const KIND = 'StorageClass';

    /**
     * AllowVolumeExpansion shows whether the storage class allow volume expand
     */
    private bool|null $allowVolumeExpansion = null;

    /**
     * Restrict the node topologies where volumes can be dynamically provisioned. Each
     * volume plugin defines its own supported topology specifications. An empty
     * TopologySelectorTerm list means there is no topology restriction. This field is
     * only honored by servers that enable the VolumeScheduling feature.
     */
    private TopologySelectorTermList $allowedTopologies;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Dynamically provisioned PersistentVolumes of this storage class are created with
     * these mountOptions, e.g. ["ro", "soft"]. Not validated - mount of the PVs will
     * simply fail if one is invalid.
     */
    private StringList $mountOptions;

    /**
     * Parameters holds the parameters for the provisioner that should create volumes
     * of this storage class.
     */
    private StringMap $parameters;

    /**
     * Provisioner indicates the type of the provisioner.
     */
    private string $provisioner;

    /**
     * Dynamically provisioned PersistentVolumes of this storage class are created with
     * this reclaimPolicy. Defaults to Delete.
     */
    private string|null $reclaimPolicy = null;

    /**
     * VolumeBindingMode indicates how PersistentVolumeClaims should be provisioned and
     * bound.  When unset, VolumeBindingImmediate is used. This field is only honored
     * by servers that enable the VolumeScheduling feature.
     */
    private string|null $volumeBindingMode = null;

    public function __construct(string $provisioner)
    {
        $this->allowedTopologies = new TopologySelectorTermList();
        $this->metadata = new ObjectMeta();
        $this->mountOptions = new StringList();
        $this->parameters = new StringMap();
        $this->provisioner = $provisioner;
    }

    public function allowedTopologies(): TopologySelectorTermList
    {
        return $this->allowedTopologies;
    }

    public function getAllowVolumeExpansion(): bool|null
    {
        return $this->allowVolumeExpansion;
    }

    public function getProvisioner(): string
    {
        return $this->provisioner;
    }

    public function getReclaimPolicy(): string|null
    {
        return $this->reclaimPolicy;
    }

    public function getVolumeBindingMode(): string|null
    {
        return $this->volumeBindingMode;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function mountOptions(): StringList
    {
        return $this->mountOptions;
    }

    public function parameters(): StringMap
    {
        return $this->parameters;
    }

    public function setAllowVolumeExpansion(bool $allowVolumeExpansion): self
    {
        $this->allowVolumeExpansion = $allowVolumeExpansion;

        return $this;
    }

    public function setProvisioner(string $provisioner): self
    {
        $this->provisioner = $provisioner;

        return $this;
    }

    public function setReclaimPolicy(string $reclaimPolicy): self
    {
        $this->reclaimPolicy = $reclaimPolicy;

        return $this;
    }

    public function setVolumeBindingMode(string $volumeBindingMode): self
    {
        $this->volumeBindingMode = $volumeBindingMode;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'allowVolumeExpansion' => $this->allowVolumeExpansion,
            'allowedTopologies' => $this->allowedTopologies,
            'metadata' => $this->metadata,
            'mountOptions' => $this->mountOptions,
            'parameters' => $this->parameters,
            'provisioner' => $this->provisioner,
            'reclaimPolicy' => $this->reclaimPolicy,
            'volumeBindingMode' => $this->volumeBindingMode,
        ];
    }
}
