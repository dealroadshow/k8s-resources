<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Authorization;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\SubjectAccessReviewSpec;

/**
 * SubjectAccessReview checks whether or not a user or group can perform an action.
 */
class SubjectAccessReview implements APIResourceInterface
{
    public const API_VERSION = 'authorization.k8s.io/v1';
    public const KIND = 'SubjectAccessReview';

    private ObjectMeta $metadata;

    /**
     * Spec holds information about the request being evaluated
     */
    private SubjectAccessReviewSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new SubjectAccessReviewSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): SubjectAccessReviewSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
