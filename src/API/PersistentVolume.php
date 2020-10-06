<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\PersistentVolumeSpec;

/**
 * PersistentVolume (PV) is a storage resource provisioned by an administrator. It
 * is analogous to a node. More info:
 * https://kubernetes.io/docs/concepts/storage/persistent-volumes
 */
class PersistentVolume implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'PersistentVolume';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines a specification of a persistent volume owned by the cluster.
     * Provisioned by an administrator. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#persistent-volumes
     */
    private PersistentVolumeSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PersistentVolumeSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PersistentVolumeSpec
    {
        return $this->spec;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
