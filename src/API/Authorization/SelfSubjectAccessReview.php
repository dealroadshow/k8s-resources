<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Authorization;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\SelfSubjectAccessReviewSpec;

/**
 * SelfSubjectAccessReview checks whether or the current user can perform an
 * action.  Not filling in a spec.namespace means "in all namespaces".  Self is a
 * special case, because users should always be able to check whether they can
 * perform an action
 */
class SelfSubjectAccessReview implements APIResourceInterface
{
    public const API_VERSION = 'authorization.k8s.io/v1';
    public const KIND = 'SelfSubjectAccessReview';

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec holds information about the request being evaluated.  user and groups must
     * be empty
     */
    private SelfSubjectAccessReviewSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new SelfSubjectAccessReviewSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): SelfSubjectAccessReviewSpec
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
