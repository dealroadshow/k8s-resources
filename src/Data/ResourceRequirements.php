<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ResourceClaimList;
use Dealroadshow\K8S\Data\Collection\StringOrFloatMap;
use JsonSerializable;

/**
 * ResourceRequirements describes the compute resource requirements.
 */
class ResourceRequirements implements JsonSerializable
{
    /**
     * Claims lists the names of resources, defined in spec.resourceClaims, that are
     * used by this container.
     *
     * This is an alpha field and requires enabling the DynamicResourceAllocation
     * feature gate.
     *
     * This field is immutable. It can only be set for containers.
     */
    private ResourceClaimList $claims;

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
        $this->claims = new ResourceClaimList();
        $this->limits = new StringOrFloatMap();
        $this->requests = new StringOrFloatMap();
    }

    public function claims(): ResourceClaimList
    {
        return $this->claims;
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
            'claims' => $this->claims,
            'limits' => $this->limits,
            'requests' => $this->requests,
        ];
    }
}
