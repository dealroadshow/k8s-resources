<?php 

namespace Dealroadshow\K8S\API\Authentication;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\TokenRequestSpec;

/**
 * TokenRequest requests a token for a given service account.
 */
class TokenRequest implements APIResourceInterface
{
    public const API_VERSION = 'authentication.k8s.io/v1';
    public const KIND = 'TokenRequest';

    private ObjectMeta $metadata;
    private TokenRequestSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new TokenRequestSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): TokenRequestSpec
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
