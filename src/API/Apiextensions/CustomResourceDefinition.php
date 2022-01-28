<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Apiextensions;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\CustomResourceDefinitionSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * CustomResourceDefinition represents a resource that should be exposed on the API
 * server.  Its name MUST be in the format <.spec.name>.<.spec.group>.
 */
class CustomResourceDefinition implements APIResourceInterface
{
    public const API_VERSION = 'apiextensions.k8s.io/v1';
    public const KIND = 'CustomResourceDefinition';

    private ObjectMeta $metadata;

    /**
     * spec describes how the user wants the resources to appear
     */
    private CustomResourceDefinitionSpec $spec;

    public function __construct(CustomResourceDefinitionSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): CustomResourceDefinitionSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(CustomResourceDefinitionSpec $spec): self
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
