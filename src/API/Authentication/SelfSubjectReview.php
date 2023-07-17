<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Authentication;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * SelfSubjectReview contains the user information that the kube-apiserver has
 * about the user making this request. When using impersonation, users will receive
 * the user info of the user being impersonated.
 */
class SelfSubjectReview implements APIResourceInterface
{
    public const API_VERSION = 'authentication.k8s.io/v1alpha1';
    public const KIND = 'SelfSubjectReview';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
        ];
    }
}
