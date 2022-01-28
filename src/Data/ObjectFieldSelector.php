<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ObjectFieldSelector selects an APIVersioned field of an object.
 */
class ObjectFieldSelector implements JsonSerializable
{
    /**
     * Version of the schema the FieldPath is written in terms of, defaults to "v1".
     */
    private string|null $apiVersion = null;

    /**
     * Path of the field to select in the specified API version.
     */
    private string $fieldPath;

    public function __construct(string $fieldPath)
    {
        $this->fieldPath = $fieldPath;
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getFieldPath(): string
    {
        return $this->fieldPath;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setFieldPath(string $fieldPath): self
    {
        $this->fieldPath = $fieldPath;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => $this->apiVersion,
            'fieldPath' => $this->fieldPath,
        ];
    }
}
