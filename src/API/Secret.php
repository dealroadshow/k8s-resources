<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\StringMap;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Secret holds secret data of a certain type. The total bytes of the values in the
 * Data field must be less than MaxSecretSize bytes.
 */
class Secret implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'Secret';

    /**
     * Data contains the secret data. Each key must consist of alphanumeric characters,
     * '-', '_' or '.'. The serialized form of the secret data is a base64 encoded
     * string, representing the arbitrary (possibly non-string) data value here.
     * Described in https://tools.ietf.org/html/rfc4648#section-4
     */
    private StringMap $data;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * stringData allows specifying non-binary secret data in string form. It is
     * provided as a write-only convenience method. All keys and values are merged into
     * the data field on write, overwriting any existing values. It is never output
     * when reading from the API.
     */
    private StringMap $stringData;

    /**
     * Used to facilitate programmatic handling of secret data.
     */
    private string|null $type = null;

    public function __construct()
    {
        $this->data = new StringMap();
        $this->metadata = new ObjectMeta();
        $this->stringData = new StringMap();
    }

    public function data(): StringMap
    {
        return $this->data;
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function stringData(): StringMap
    {
        return $this->stringData;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'data' => $this->data,
            'metadata' => $this->metadata,
            'stringData' => $this->stringData,
            'type' => $this->type,
        ];
    }
}
