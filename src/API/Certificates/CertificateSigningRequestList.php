<?php 

namespace Dealroadshow\K8S\API\Certificates;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * CertificateSigningRequestList is a collection of CertificateSigningRequest
 * objects
 */
class CertificateSigningRequestList implements APIResourceListInterface
{
    public const API_VERSION = 'certificates.k8s.io/v1';
    public const KIND = 'CertificateSigningRequestList';

    /**
     * @var CertificateSigningRequest[]
     */
    private array $items = [];
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(CertificateSigningRequest $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var CertificateSigningRequest[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return CertificateSigningRequest[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function metadata(): ListMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ];
    }
}
