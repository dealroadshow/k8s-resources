<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * VolumeNodeAffinity defines constraints that limit what nodes this volume can be
 * accessed from.
 */
class VolumeNodeAffinity implements JsonSerializable
{
    /**
     * Required specifies hard node constraints that must be met.
     */
    private NodeSelector $required;

    public function __construct()
    {
        $this->required = new NodeSelector();
    }

    public function required(): NodeSelector
    {
        return $this->required;
    }

    public function jsonSerialize()
    {
        return [
            'required' => $this->required,
        ];
    }
}
