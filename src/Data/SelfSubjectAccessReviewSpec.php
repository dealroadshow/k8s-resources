<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SelfSubjectAccessReviewSpec is a description of the access request.  Exactly one
 * of ResourceAuthorizationAttributes and NonResourceAuthorizationAttributes must
 * be set
 */
class SelfSubjectAccessReviewSpec implements JsonSerializable
{
    /**
     * NonResourceAttributes describes information for a non-resource access request
     */
    private NonResourceAttributes $nonResourceAttributes;

    /**
     * ResourceAuthorizationAttributes describes information for a resource access
     * request
     */
    private ResourceAttributes $resourceAttributes;

    public function __construct()
    {
        $this->nonResourceAttributes = new NonResourceAttributes();
        $this->resourceAttributes = new ResourceAttributes();
    }

    public function nonResourceAttributes(): NonResourceAttributes
    {
        return $this->nonResourceAttributes;
    }

    public function resourceAttributes(): ResourceAttributes
    {
        return $this->resourceAttributes;
    }

    public function jsonSerialize(): array
    {
        return [
            'nonResourceAttributes' => $this->nonResourceAttributes,
            'resourceAttributes' => $this->resourceAttributes,
        ];
    }
}
