<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ForZoneList;
use JsonSerializable;

/**
 * EndpointHints provides hints describing how an endpoint should be consumed.
 */
class EndpointHints implements JsonSerializable
{
    /**
     * forZones indicates the zone(s) this endpoint should be consumed by to enable
     * topology aware routing.
     */
    private ForZoneList $forZones;

    public function __construct()
    {
        $this->forZones = new ForZoneList();
    }

    public function forZones(): ForZoneList
    {
        return $this->forZones;
    }

    public function jsonSerialize(): array
    {
        return [
            'forZones' => $this->forZones,
        ];
    }
}
