<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a Flocker volume mounted by the Flocker agent. One and only one of
 * datasetName and datasetUUID should be set. Flocker volumes do not support
 * ownership management or SELinux relabeling.
 */
class FlockerVolumeSource implements JsonSerializable
{
    /**
     * Name of the dataset stored as metadata -> name on the dataset for Flocker should
     * be considered as deprecated
     *
     * @var string|null
     */
    private ?string $datasetName = null;

    /**
     * UUID of the dataset. This is unique identifier of a Flocker dataset
     *
     * @var string|null
     */
    private ?string $datasetUUID = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getDatasetName(): ?string
    {
        return $this->datasetName;
    }

    /**
     * @return string|null
     */
    public function getDatasetUUID(): ?string
    {
        return $this->datasetUUID;
    }

    public function setDatasetName(string $datasetName): self
    {
        $this->datasetName = $datasetName;

        return $this;
    }

    public function setDatasetUUID(string $datasetUUID): self
    {
        $this->datasetUUID = $datasetUUID;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'datasetName' => $this->datasetName,
            'datasetUUID' => $this->datasetUUID,
        ];
    }
}
