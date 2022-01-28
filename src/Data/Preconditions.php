<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Preconditions must be fulfilled before an operation (update, delete, etc.) is
 * carried out.
 */
class Preconditions implements JsonSerializable
{
    /**
     * Specifies the target ResourceVersion
     */
    private string|null $resourceVersion = null;

    /**
     * Specifies the target UID.
     */
    private string|null $uid = null;

    public function __construct()
    {
    }

    public function getResourceVersion(): string|null
    {
        return $this->resourceVersion;
    }

    public function getUid(): string|null
    {
        return $this->uid;
    }

    public function setResourceVersion(string $resourceVersion): self
    {
        $this->resourceVersion = $resourceVersion;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'resourceVersion' => $this->resourceVersion,
            'uid' => $this->uid,
        ];
    }
}
