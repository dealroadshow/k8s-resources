<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\CSINodeDriverList;
use JsonSerializable;

/**
 * CSINodeSpec holds information about the specification of all CSI drivers
 * installed on a node
 */
class CSINodeSpec implements JsonSerializable
{
    /**
     * drivers is a list of information of all CSI Drivers existing on a node. If all
     * drivers in the list are uninstalled, this can become empty.
     */
    private CSINodeDriverList $drivers;

    public function __construct()
    {
        $this->drivers = new CSINodeDriverList();
    }

    public function drivers(): CSINodeDriverList
    {
        return $this->drivers;
    }

    public function jsonSerialize(): array
    {
        return [
            'drivers' => $this->drivers,
        ];
    }
}
