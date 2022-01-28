<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringOrFloatMap;
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
    private StringOrFloatMap $podFixed;

    public function __construct()
    {
        $this->podFixed = new StringOrFloatMap();
    }

    public function podFixed(): StringOrFloatMap
    {
        return $this->podFixed;
    }

    public function jsonSerialize(): array
    {
        return [
            'podFixed' => $this->podFixed,
        ];
    }
}
