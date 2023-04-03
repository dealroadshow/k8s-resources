<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents an empty directory for a pod. Empty directory volumes support
 * ownership management and SELinux relabeling.
 */
class EmptyDirVolumeSource implements JsonSerializable
{
    /**
     * medium represents what type of storage medium should back this directory. The
     * default is "" which means to use the node's default medium. Must be an empty
     * string (default) or Memory. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#emptydir
     */
    private string|null $medium = null;

    /**
     * sizeLimit is the total amount of local storage required for this EmptyDir
     * volume. The size limit is also applicable for memory medium. The maximum usage
     * on memory medium EmptyDir would be the minimum value between the SizeLimit
     * specified here and the sum of memory limits of all containers in a pod. The
     * default is nil which means that the limit is undefined. More info:
     * http://kubernetes.io/docs/user-guide/volumes#emptydir
     */
    private string|float|null $sizeLimit = null;

    public function __construct()
    {
    }

    public function getMedium(): string|null
    {
        return $this->medium;
    }

    public function getSizeLimit(): string|float|null
    {
        return $this->sizeLimit;
    }

    public function setMedium(string $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function setSizeLimit(string|float $sizeLimit): self
    {
        $this->sizeLimit = $sizeLimit;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'medium' => $this->medium,
            'sizeLimit' => $this->sizeLimit,
        ];
    }
}
