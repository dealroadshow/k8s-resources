<?php 

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
     *
     * @var string|null
     */
    private ?string $resourceVersion = null;

    /**
     * Specifies the target UID.
     *
     * @var string|null
     */
    private ?string $uid = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getResourceVersion(): ?string
    {
        return $this->resourceVersion;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
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

    public function jsonSerialize()
    {
        return [
            'resourceVersion' => $this->resourceVersion,
            'uid' => $this->uid,
        ];
    }
}
