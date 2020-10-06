<?php 

namespace Dealroadshow\K8S\API\Storage;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\VolumeAttachmentSpec;

/**
 * VolumeAttachment captures the intent to attach or detach the specified volume
 * to/from the specified node.
 *
 * VolumeAttachment objects are non-namespaced.
 */
class VolumeAttachment implements APIResourceInterface
{
    const API_VERSION = 'storage.k8s.io/v1';
    const KIND = 'VolumeAttachment';

    /**
     * Standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired attach/detach volume behavior. Populated by the
     * Kubernetes system.
     */
    private VolumeAttachmentSpec $spec;

    public function __construct(VolumeAttachmentSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): VolumeAttachmentSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(VolumeAttachmentSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
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
