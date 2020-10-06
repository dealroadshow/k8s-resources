<?php 

namespace Dealroadshow\K8S\API\Certificates;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

class CertificateSigningRequestList implements APIResourceListInterface
{
    const API_VERSION = 'certificates.k8s.io/v1beta1';
    const KIND = 'CertificateSigningRequestList';

    /**
     * @var CertificateSigningRequest[]|array
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
     * @var CertificateSigningRequest[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return CertificateSigningRequest[]|array
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

    public function metadata(): ListMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ];
    }
}
