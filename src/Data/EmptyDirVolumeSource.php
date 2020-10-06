<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\Quantity;
use JsonSerializable;

/**
 * Represents an empty directory for a pod. Empty directory volumes support
 * ownership management and SELinux relabeling.
 */
class EmptyDirVolumeSource implements JsonSerializable
{
    /**
     * What type of storage medium should back this directory. The default is "" which
     * means to use the node's default medium. Must be an empty string (default) or
     * Memory. More info: https://kubernetes.io/docs/concepts/storage/volumes#emptydir
     *
     * @var string|null
     */
    private ?string $medium = null;

    /**
     * Total amount of local storage required for this EmptyDir volume. The size limit
     * is also applicable for memory medium. The maximum usage on memory medium
     * EmptyDir would be the minimum value between the SizeLimit specified here and the
     * sum of memory limits of all containers in a pod. The default is nil which means
     * that the limit is undefined. More info:
     * http://kubernetes.io/docs/user-guide/volumes#emptydir
     *
     * @var Quantity|null
     */
    private ?Quantity $sizeLimit = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getMedium(): ?string
    {
        return $this->medium;
    }

    /**
     * @return Quantity|null
     */
    public function getSizeLimit(): ?Quantity
    {
        return $this->sizeLimit;
    }

    public function setMedium(string $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function setSizeLimit(Quantity $sizeLimit): self
    {
        $this->sizeLimit = $sizeLimit;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'medium' => $this->medium,
            'sizeLimit' => $this->sizeLimit,
        ];
    }
}
