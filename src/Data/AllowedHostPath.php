<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * AllowedHostPath defines the host volume conditions that will be enabled by a
 * policy for pods to use. It requires the path prefix to be defined. Deprecated:
 * use AllowedHostPath from policy API Group instead.
 */
class AllowedHostPath implements JsonSerializable
{
    /**
     * pathPrefix is the path prefix that the host volume must match. It does not
     * support `*`. Trailing slashes are trimmed when validating the path prefix with a
     * host path.
     *
     * Examples: `/foo` would allow `/foo`, `/foo/` and `/foo/bar` `/foo` would not
     * allow `/food` or `/etc/foo`
     *
     * @var string|null
     */
    private ?string $pathPrefix = null;

    /**
     * when set to true, will allow host volumes matching the pathPrefix only if all
     * volume mounts are readOnly.
     *
     * @var bool|null
     */
    private ?bool $readOnly = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getPathPrefix(): ?string
    {
        return $this->pathPrefix;
    }

    /**
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function setPathPrefix(string $pathPrefix): self
    {
        $this->pathPrefix = $pathPrefix;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'pathPrefix' => $this->pathPrefix,
            'readOnly' => $this->readOnly,
        ];
    }
}
