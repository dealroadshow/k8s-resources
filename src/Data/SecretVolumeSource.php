<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\KeyToPathList;
use JsonSerializable;

/**
 * Adapts a Secret into a volume.
 *
 * The contents of the target Secret's Data field will be presented in a volume as
 * files using the keys in the Data field as the file names. Secret volumes support
 * ownership management and SELinux relabeling.
 */
class SecretVolumeSource implements JsonSerializable
{
    /**
     * Optional: mode bits used to set permissions on created files by default. Must be
     * an octal value between 0000 and 0777 or a decimal value between 0 and 511. YAML
     * accepts both octal and decimal values, JSON requires decimal values for mode
     * bits. Defaults to 0644. Directories within the path are not affected by this
     * setting. This might be in conflict with other options that affect the file mode,
     * like fsGroup, and the result can be other mode bits set.
     */
    private int|null $defaultMode = null;

    /**
     * If unspecified, each key-value pair in the Data field of the referenced Secret
     * will be projected into the volume as a file whose name is the key and content is
     * the value. If specified, the listed keys will be projected into the specified
     * paths, and unlisted keys will not be present. If a key is specified which is not
     * present in the Secret, the volume setup will error unless it is marked optional.
     * Paths must be relative and may not contain the '..' path or start with '..'.
     */
    private KeyToPathList $items;

    /**
     * Specify whether the Secret or its keys must be defined
     */
    private bool|null $optional = null;

    /**
     * Name of the secret in the pod's namespace to use. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#secret
     */
    private string|null $secretName = null;

    public function __construct()
    {
        $this->items = new KeyToPathList();
    }

    public function getDefaultMode(): int|null
    {
        return $this->defaultMode;
    }

    public function getOptional(): bool|null
    {
        return $this->optional;
    }

    public function getSecretName(): string|null
    {
        return $this->secretName;
    }

    public function items(): KeyToPathList
    {
        return $this->items;
    }

    public function setDefaultMode(int $defaultMode): self
    {
        $this->defaultMode = $defaultMode;

        return $this;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function setSecretName(string $secretName): self
    {
        $this->secretName = $secretName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'defaultMode' => $this->defaultMode,
            'items' => $this->items,
            'optional' => $this->optional,
            'secretName' => $this->secretName,
        ];
    }
}
