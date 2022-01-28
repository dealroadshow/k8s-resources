<?php 

namespace Dealroadshow\K8S\API\Apiregistration;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\APIServiceSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * APIService represents a server for a particular GroupVersion. Name must be
 * "version.group".
 */
class APIService implements APIResourceInterface
{
    public const API_VERSION = 'apiregistration.k8s.io/v1';
    public const KIND = 'APIService';

    private ObjectMeta $metadata;

    /**
     * Spec contains information for locating and communicating with a server
     */
    private APIServiceSpec $spec;

    public function __construct(APIServiceSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): APIServiceSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(APIServiceSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
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
