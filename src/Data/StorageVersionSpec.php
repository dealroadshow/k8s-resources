<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * StorageVersionSpec is an empty spec.
 */
class StorageVersionSpec implements JsonSerializable
{
    public function __construct()
    {
    }

    public function jsonSerialize(): array
    {
        return [
        ];
    }
}
