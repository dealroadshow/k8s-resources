<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringOrFloatMap;
use JsonSerializable;

/**
 * ResourceRequirements describes the compute resource requirements.
 */
class ResourceRequirements implements JsonSerializable
{
    /**
     * Limits describes the maximum amount of compute resources allowed. More info:
     * https://kubernetes.io/docs/concepts/configuration/manage-resources-containers/
     */
    private StringOrFloatMap $limits;

    /**
     * Requests describes the minimum amount of compute resources required. If Requests
     * is omitted for a container, it defaults to Limits if that is explicitly
     * specified, otherwise to an implementation-defined value. More info:
     * https://kubernetes.io/docs/concepts/configuration/manage-resources-containers/
     */
    private StringOrFloatMap $requests;

    public function __construct()
    {
        $this->limits = new StringOrFloatMap();
        $this->requests = new StringOrFloatMap();
    }

    public function limits(): StringOrFloatMap
    {
        return $this->limits;
    }

    public function requests(): StringOrFloatMap
    {
        return $this->requests;
    }

    public function jsonSerialize(): array
    {
        return [
            'limits' => $this->limits,
            'requests' => $this->requests,
        ];
    }
}
