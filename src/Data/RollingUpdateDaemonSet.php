<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\IntOrString;
use JsonSerializable;

/**
 * Spec to control the desired behavior of daemon set rolling update.
 */
class RollingUpdateDaemonSet implements JsonSerializable
{
    /**
     * The maximum number of DaemonSet pods that can be unavailable during the update.
     * Value can be an absolute number (ex: 5) or a percentage of total number of
     * DaemonSet pods at the start of the update (ex: 10%). Absolute number is
     * calculated from percentage by rounding up. This cannot be 0. Default value is 1.
     * Example: when this is set to 30%, at most 30% of the total number of nodes that
     * should be running the daemon pod (i.e. status.desiredNumberScheduled) can have
     * their pods stopped for an update at any given time. The update starts by
     * stopping at most 30% of those DaemonSet pods and then brings up new DaemonSet
     * pods in their place. Once the new pods are available, it then proceeds onto
     * other DaemonSet pods, thus ensuring that at least 70% of original number of
     * DaemonSet pods are available at all times during the update.
     *
     * @var IntOrString|null
     */
    private ?IntOrString $maxUnavailable = null;

    public function __construct()
    {
    }

    /**
     * @return IntOrString|null
     */
    public function getMaxUnavailable(): ?IntOrString
    {
        return $this->maxUnavailable;
    }

    public function setMaxUnavailable(IntOrString $maxUnavailable): self
    {
        $this->maxUnavailable = $maxUnavailable;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'maxUnavailable' => $this->maxUnavailable,
        ];
    }
}
