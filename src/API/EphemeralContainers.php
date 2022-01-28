<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\EphemeralContainerList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * A list of ephemeral containers used with the Pod ephemeralcontainers
 * subresource.
 */
class EphemeralContainers implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'EphemeralContainers';

    /**
     * A list of ephemeral containers associated with this pod. New ephemeral
     * containers may be appended to this list, but existing ephemeral containers may
     * not be removed or modified.
     */
    private EphemeralContainerList $ephemeralContainers;
    private ObjectMeta $metadata;

    public function __construct()
    {
        $this->ephemeralContainers = new EphemeralContainerList();
        $this->metadata = new ObjectMeta();
    }

    public function ephemeralContainers(): EphemeralContainerList
    {
        return $this->ephemeralContainers;
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
            'ephemeralContainers' => $this->ephemeralContainers,
            'metadata' => $this->metadata,
        ];
    }
}
