<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\KeyToPathList;
use JsonSerializable;

/**
 * Adapts a secret into a projected volume.
 *
 * The contents of the target Secret's Data field will be presented in a projected
 * volume as files using the keys in the Data field as the file names. Note that
 * this is identical to a secret volume source without the default mode.
 */
class SecretProjection implements JsonSerializable
{
    /**
     * items if unspecified, each key-value pair in the Data field of the referenced
     * Secret will be projected into the volume as a file whose name is the key and
     * content is the value. If specified, the listed keys will be projected into the
     * specified paths, and unlisted keys will not be present. If a key is specified
     * which is not present in the Secret, the volume setup will error unless it is
     * marked optional. Paths must be relative and may not contain the '..' path or
     * start with '..'.
     */
    private KeyToPathList $items;

    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string|null $name = null;

    /**
     * optional field specify whether the Secret or its key must be defined
     */
    private bool|null $optional = null;

    public function __construct()
    {
        $this->items = new KeyToPathList();
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getOptional(): bool|null
    {
        return $this->optional;
    }

    public function items(): KeyToPathList
    {
        return $this->items;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'items' => $this->items,
            'name' => $this->name,
            'optional' => $this->optional,
        ];
    }
}
