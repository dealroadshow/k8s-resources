<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * TopologySpreadConstraint specifies how to spread matching pods among the given
 * topology.
 */
class TopologySpreadConstraint implements JsonSerializable
{
    /**
     * LabelSelector is used to find matching pods. Pods that match this label selector
     * are counted to determine the number of pods in their corresponding topology
     * domain.
     */
    private LabelSelector $labelSelector;

    /**
     * MaxSkew describes the degree to which pods may be unevenly distributed. It's the
     * maximum permitted difference between the number of matching pods in any two
     * topology domains of a given topology type. For example, in a 3-zone cluster,
     * MaxSkew is set to 1, and pods with the same labelSelector spread as 1/1/0: |
     * zone1 | zone2 | zone3 | |   P   |   P   |       | - if MaxSkew is 1, incoming
     * pod can only be scheduled to zone3 to become 1/1/1; scheduling it onto
     * zone1(zone2) would make the ActualSkew(2-0) on zone1(zone2) violate MaxSkew(1).
     * - if MaxSkew is 2, incoming pod can be scheduled onto any zone. It's a required
     * field. Default value is 1 and 0 is not allowed.
     */
    private int $maxSkew;

    /**
     * TopologyKey is the key of node labels. Nodes that have a label with this key and
     * identical values are considered to be in the same topology. We consider each
     * <key, value> as a "bucket", and try to put balanced number of pods into each
     * bucket. It's a required field.
     */
    private string $topologyKey;

    /**
     * WhenUnsatisfiable indicates how to deal with a pod if it doesn't satisfy the
     * spread constraint. - DoNotSchedule (default) tells the scheduler not to schedule
     * it - ScheduleAnyway tells the scheduler to still schedule it It's considered as
     * "Unsatisfiable" if and only if placing incoming pod on any topology violates
     * "MaxSkew". For example, in a 3-zone cluster, MaxSkew is set to 1, and pods with
     * the same labelSelector spread as 3/1/1: | zone1 | zone2 | zone3 | | P P P |   P
     *  |   P   | If WhenUnsatisfiable is set to DoNotSchedule, incoming pod can only
     * be scheduled to zone2(zone3) to become 3/2/1(3/1/2) as ActualSkew(2-1) on
     * zone2(zone3) satisfies MaxSkew(1). In other words, the cluster can still be
     * imbalanced, but scheduler won't make it *more* imbalanced. It's a required
     * field.
     */
    private string $whenUnsatisfiable;

    public function __construct(int $maxSkew, string $topologyKey, string $whenUnsatisfiable)
    {
        $this->labelSelector = new LabelSelector();
        $this->maxSkew = $maxSkew;
        $this->topologyKey = $topologyKey;
        $this->whenUnsatisfiable = $whenUnsatisfiable;
    }

    public function getMaxSkew(): int
    {
        return $this->maxSkew;
    }

    public function getTopologyKey(): string
    {
        return $this->topologyKey;
    }

    public function getWhenUnsatisfiable(): string
    {
        return $this->whenUnsatisfiable;
    }

    public function labelSelector(): LabelSelector
    {
        return $this->labelSelector;
    }

    public function setMaxSkew(int $maxSkew): self
    {
        $this->maxSkew = $maxSkew;

        return $this;
    }

    public function setTopologyKey(string $topologyKey): self
    {
        $this->topologyKey = $topologyKey;

        return $this;
    }

    public function setWhenUnsatisfiable(string $whenUnsatisfiable): self
    {
        $this->whenUnsatisfiable = $whenUnsatisfiable;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'labelSelector' => $this->labelSelector,
            'maxSkew' => $this->maxSkew,
            'topologyKey' => $this->topologyKey,
            'whenUnsatisfiable' => $this->whenUnsatisfiable,
        ];
    }
}
