<?php 

namespace Dealroadshow\K8S\API\Authorization;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\SubjectAccessReviewSpec;

/**
 * LocalSubjectAccessReview checks whether or not a user or group can perform an
 * action in a given namespace. Having a namespace scoped resource makes it much
 * easier to grant namespace scoped policy that includes permissions checking.
 */
class LocalSubjectAccessReview implements APIResourceInterface
{
    public const API_VERSION = 'authorization.k8s.io/v1';
    public const KIND = 'LocalSubjectAccessReview';

    private ObjectMeta $metadata;

    /**
     * Spec holds information about the request being evaluated.  spec.namespace must
     * be equal to the namespace you made the request against.  If empty, it is
     * defaulted.
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
