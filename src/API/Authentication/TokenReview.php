<?php 

namespace Dealroadshow\K8S\API\Authentication;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\TokenReviewSpec;

/**
 * TokenReview attempts to authenticate a token to a known user. Note: TokenReview
 * requests may be cached by the webhook token authenticator plugin in the
 * kube-apiserver.
 */
class TokenReview implements APIResourceInterface
{
    const API_VERSION = 'authentication.k8s.io/v1';
    const KIND = 'TokenReview';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec holds information about the request being evaluated
     */
    private TokenReviewSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new TokenReviewSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): TokenReviewSpec
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
