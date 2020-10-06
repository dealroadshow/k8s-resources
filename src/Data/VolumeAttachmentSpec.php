<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * VolumeAttachmentSpec is the specification of a VolumeAttachment request.
 */
class VolumeAttachmentSpec implements JsonSerializable
{
    /**
     * Attacher indicates the name of the volume driver that MUST handle this request.
     * This is the name returned by GetPluginName().
     */
    private string $attacher;

    /**
     * The node that the volume should be attached to.
     */
    private string $nodeName;

    /**
     * Source represents the volume that should be attached.
     */
    private VolumeAttachmentSource $source;

    public function __construct(string $attacher, string $nodeName)
    {
        $this->attacher = $attacher;
        $this->nodeName = $nodeName;
        $this->source = new VolumeAttachmentSource();
    }

    public function getAttacher(): string
    {
        return $this->attacher;
    }

    public function getNodeName(): string
    {
        return $this->nodeName;
    }

    public function setAttacher(string $attacher): self
    {
        $this->attacher = $attacher;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function source(): VolumeAttachmentSource
    {
        return $this->source;
    }

    public function jsonSerialize()
    {
        return [
            'attacher' => $this->attacher,
            'nodeName' => $this->nodeName,
            'source' => $this->source,
        ];
    }
}
