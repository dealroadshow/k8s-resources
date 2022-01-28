<?php

declare(strict_types=1);

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
     */
    private CustomResourceSubresourceScale|null $scale = null;

    public function __construct()
    {
    }

    public function getScale(): CustomResourceSubresourceScale|null
    {
        return $this->scale;
    }

    public function setScale(CustomResourceSubresourceScale $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'scale' => $this->scale,
        ];
    }
}
