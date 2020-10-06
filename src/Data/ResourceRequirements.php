<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\QuantityMap;
use JsonSerializable;

/**
 * ResourceRequirements describes the compute resource requirements.
 */
class ResourceRequirements implements JsonSerializable
{
    /**
     * Limits describes the maximum amount of compute resources allowed. More info:
     * https://kubernetes.io/docs/concepts/configuration/manage-compute-resources-container/
     */
    private QuantityMap $limits;

    /**
     * Requests describes the minimum amount of compute resources required. If Requests
     * is omitted for a container, it defaults to Limits if that is explicitly
     * specified, otherwise to an implementation-defined value. More info:
     * https://kubernetes.io/docs/concepts/configuration/manage-compute-resources-container/
     */
    private QuantityMap $requests;

    public function __construct()
    {
        $this->limits = new QuantityMap();
        $this->requests = new QuantityMap();
    }

    public function limits(): QuantityMap
    {
        return $this->limits;
    }

    public function requests(): QuantityMap
    {
        return $this->requests;
    }

    public function jsonSerialize()
    {
        return [
            'limits' => $this->limits,
            'requests' => $this->requests,
        ];
    }
}
