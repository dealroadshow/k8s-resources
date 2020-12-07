<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\StringMap;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * ConfigMap holds configuration data for pods to consume.
 */
class ConfigMap implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'ConfigMap';

    /**
     * BinaryData contains the binary data. Each key must consist of alphanumeric
     * characters, '-', '_' or '.'. BinaryData can contain byte sequences that are not
     * in the UTF-8 range. The keys stored in BinaryData must not overlap with the ones
     * in the Data field, this is enforced during validation process. Using this field
     * will require 1.10+ apiserver and kubelet.
     */
    private StringMap $binaryData;

    /**
     * Data contains the configuration data. Each key must consist of alphanumeric
     * characters, '-', '_' or '.'. Values with non-UTF-8 byte sequences must use the
     * BinaryData field. The keys stored in Data must not overlap with the keys in the
     * BinaryData field, this is enforced during validation process.
     */
    private StringMap $data;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    public function __construct()
    {
        $this->binaryData = new StringMap();
        $this->data = new StringMap();
        $this->metadata = new ObjectMeta();
    }

    public function binaryData(): StringMap
    {
        return $this->binaryData;
    }

    public function data(): StringMap
    {
        return $this->data;
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
            'binaryData' => $this->binaryData,
            'data' => $this->data,
            'metadata' => $this->metadata,
        ];
    }
}
