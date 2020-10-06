<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * CustomResourceValidation is a list of validation methods for CustomResources.
 */
class CustomResourceValidation implements JsonSerializable
{
    /**
     * openAPIV3Schema is the OpenAPI v3 schema to use for validation and pruning.
     *
     * @var JSONSchemaProps|null
     */
    private ?JSONSchemaProps $openAPIV3Schema = null;

    public function __construct()
    {
    }

    /**
     * @return JSONSchemaProps|null
     */
    public function getOpenAPIV3Schema(): ?JSONSchemaProps
    {
        return $this->openAPIV3Schema;
    }

    public function setOpenAPIV3Schema(JSONSchemaProps $openAPIV3Schema): self
    {
        $this->openAPIV3Schema = $openAPIV3Schema;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'openAPIV3Schema' => $this->openAPIV3Schema,
        ];
    }
}
