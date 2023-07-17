<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Admissionregistration;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * ValidatingAdmissionPolicyBindingList is a list of
 * ValidatingAdmissionPolicyBinding.
 */
class ValidatingAdmissionPolicyBindingList implements APIResourceListInterface
{
    public const API_VERSION = 'admissionregistration.k8s.io/v1alpha1';
    public const KIND = 'ValidatingAdmissionPolicyBindingList';

    /**
     * @var ValidatingAdmissionPolicyBinding[]
     */
    private array $items = [];

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(ValidatingAdmissionPolicyBinding $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ValidatingAdmissionPolicyBinding[] $items
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
     * @return ValidatingAdmissionPolicyBinding[]
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