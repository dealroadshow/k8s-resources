<?php 

namespace Dealroadshow\K8S\API\Storage;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\CSINodeSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * CSINode holds information about all CSI drivers installed on a node. CSI drivers
 * do not need to create the CSINode object directly. As long as they use the
 * node-driver-registrar sidecar container, the kubelet will automatically populate
 * the CSINode object for the CSI driver as part of kubelet plugin registration.
 * CSINode has the same name as a node. If the object is missing, it means either
 * there are no CSI Drivers available on the node, or the Kubelet version is low
 * enough that it doesn't create this object. CSINode has an OwnerReference that
 * points to the corresponding node object.
 */
class CSINode implements APIResourceInterface
{
    const API_VERSION = 'storage.k8s.io/v1beta1';
    const KIND = 'CSINode';

    /**
     * metadata.name must be the Kubernetes node name.
     */
    private ObjectMeta $metadata;

    /**
     * spec is the specification of CSINode
     */
    private CSINodeSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new CSINodeSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): CSINodeSpec
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
