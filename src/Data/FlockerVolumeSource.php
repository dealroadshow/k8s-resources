<?php

declare(strict_types=1);

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
     * datasetName is Name of the dataset stored as metadata -> name on the dataset for
     * Flocker should be considered as deprecated
     */
    private string|null $datasetName = null;

    /**
     * datasetUUID is the UUID of the dataset. This is unique identifier of a Flocker
     * dataset
     */
    private string|null $datasetUUID = null;

    public function __construct()
    {
    }

    public function getDatasetName(): string|null
    {
        return $this->datasetName;
    }

    public function getDatasetUUID(): string|null
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

    public function jsonSerialize(): array
    {
        return [
            'datasetName' => $this->datasetName,
            'datasetUUID' => $this->datasetUUID,
        ];
    }
}
