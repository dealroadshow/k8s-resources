<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * CustomResourceSubresources defines the status and scale subresources for
 * CustomResources.
 */
class CustomResourceSubresources implements JsonSerializable
{
    /**
     * scale indicates the custom resource should serve a `/scale` subresource that
     * returns an `autoscaling/v1` Scale object.
     *
     * @var CustomResourceSubresourceScale|null
     */
    private ?CustomResourceSubresourceScale $scale = null;

    public function __construct()
    {
    }

    /**
     * @return CustomResourceSubresourceScale|null
     */
    public function getScale(): ?CustomResourceSubresourceScale
    {
        return $this->scale;
    }

    public function setScale(CustomResourceSubresourceScale $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'scale' => $this->scale,
        ];
    }
}
