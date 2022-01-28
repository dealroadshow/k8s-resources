<?php

declare(strict_types=1);

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
    public const API_VERSION = 'v1';
    public const KIND = 'Secret';

    /**
     * Data contains the secret data. Each key must consist of alphanumeric characters,
     * '-', '_' or '.'. The serialized form of the secret data is a base64 encoded
     * string, representing the arbitrary (possibly non-string) data value here.
     * Described in https://tools.ietf.org/html/rfc4648#section-4
     */
    private StringMap $data;

    /**
     * Immutable, if set to true, ensures that data stored in the Secret cannot be
     * updated (only object metadata can be modified). If not set to true, the field
     * can be modified at any time. Defaulted to nil.
     */
    private bool|null $immutable = null;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * stringData allows specifying non-binary secret data in string form. It is
     * provided as a write-only input field for convenience. All keys and values are
     * merged into the data field on write, overwriting any existing values. The
     * stringData field is never output when reading from the API.
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

    public function getImmutable(): bool|null
    {
        return $this->immutable;
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setImmutable(bool $immutable): self
    {
        $this->immutable = $immutable;

        return $this;
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
            'immutable' => $this->immutable,
            'metadata' => $this->metadata,
            'stringData' => $this->stringData,
            'type' => $this->type,
        ];
    }
}
