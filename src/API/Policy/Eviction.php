<?php 

namespace Dealroadshow\K8S\API\Policy;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\DeleteOptions;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Eviction evicts a pod from its node subject to certain policies and safety
 * constraints. This is a subresource of Pod.  A request to cause such an eviction
 * is created by POSTing to .../pods/<pod name>/evictions.
 */
class Eviction implements APIResourceInterface
{
    public const API_VERSION = 'policy/v1beta1';
    public const KIND = 'Eviction';

    /**
     * DeleteOptions may be provided
     */
    private DeleteOptions $deleteOptions;

    /**
     * ObjectMeta describes the pod that is being evicted.
     */
    private ObjectMeta $metadata;

    public function __construct()
    {
        $this->deleteOptions = new DeleteOptions();
        $this->metadata = new ObjectMeta();
    }

    public function deleteOptions(): DeleteOptions
    {
        return $this->deleteOptions;
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
            'deleteOptions' => $this->deleteOptions,
            'metadata' => $this->metadata,
        ];
    }
}
