<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\QuantityMap;
use JsonSerializable;

/**
 * Overhead structure represents the resource overhead associated with running a
 * pod.
 */
class Overhead implements JsonSerializable
{
    /**
     * PodFixed represents the fixed resource overhead associated with running a pod.
     */
    private QuantityMap $podFixed;

    public function __construct()
    {
        $this->podFixed = new QuantityMap();
    }

    public function podFixed(): QuantityMap
    {
        return $this->podFixed;
    }

    public function jsonSerialize()
    {
        return [
            'podFixed' => $this->podFixed,
        ];
    }
}
