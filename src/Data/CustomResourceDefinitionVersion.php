<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\CustomResourceColumnDefinitionList;
use JsonSerializable;

/**
 * CustomResourceDefinitionVersion describes a version for CRD.
 */
class CustomResourceDefinitionVersion implements JsonSerializable
{
    /**
     * additionalPrinterColumns specifies additional columns returned in Table output.
     * See
     * https://kubernetes.io/docs/reference/using-api/api-concepts/#receiving-resources-as-tables
     * for details. If no columns are specified, a single column displaying the age of
     * the custom resource is used.
     */
    private CustomResourceColumnDefinitionList $additionalPrinterColumns;

    /**
     * name is the version name, e.g. “v1”, “v2beta1”, etc. The custom
     * resources are served under this version at `/apis/<group>/<version>/...` if
     * `served` is true.
     */
    private string $name;

    /**
     * schema describes the schema used for validation, pruning, and defaulting of this
     * version of the custom resource.
     */
    private CustomResourceValidation $schema;

    /**
     * served is a flag enabling/disabling this version from being served via REST APIs
     */
    private bool $served;

    /**
     * storage indicates this version should be used when persisting custom resources
     * to storage. There must be exactly one version with storage=true.
     */
    private bool $storage;

    /**
     * subresources specify what subresources this version of the defined custom
     * resource have.
     */
    private CustomResourceSubresources $subresources;

    public function __construct(string $name, bool $served, bool $storage)
    {
        $this->additionalPrinterColumns = new CustomResourceColumnDefinitionList();
        $this->name = $name;
        $this->schema = new CustomResourceValidation();
        $this->served = $served;
        $this->storage = $storage;
        $this->subresources = new CustomResourceSubresources();
    }

    public function additionalPrinterColumns(): CustomResourceColumnDefinitionList
    {
        return $this->additionalPrinterColumns;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getServed(): bool
    {
        return $this->served;
    }

    public function getStorage(): bool
    {
        return $this->storage;
    }

    public function schema(): CustomResourceValidation
    {
        return $this->schema;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setServed(bool $served): self
    {
        $this->served = $served;

        return $this;
    }

    public function setStorage(bool $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function subresources(): CustomResourceSubresources
    {
        return $this->subresources;
    }

    public function jsonSerialize(): array
    {
        return [
            'additionalPrinterColumns' => $this->additionalPrinterColumns,
            'name' => $this->name,
            'schema' => $this->schema,
            'served' => $this->served,
            'storage' => $this->storage,
            'subresources' => $this->subresources,
        ];
    }
}
