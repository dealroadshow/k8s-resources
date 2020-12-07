<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * Adds and removes POSIX capabilities from running containers.
 */
class Capabilities implements JsonSerializable
{
    /**
     * Added capabilities
     */
    private StringList $add;

    /**
     * Removed capabilities
     */
    private StringList $drop;

    public function __construct()
    {
        $this->add = new StringList();
        $this->drop = new StringList();
    }

    public function add(): StringList
    {
        return $this->add;
    }

    public function drop(): StringList
    {
        return $this->drop;
    }

    public function jsonSerialize(): array
    {
        return [
            'add' => $this->add,
            'drop' => $this->drop,
        ];
    }
}
