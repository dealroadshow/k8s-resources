<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\PodAffinityTermList;
use Dealroadshow\K8S\Data\Collection\WeightedPodAffinityTermList;
use JsonSerializable;

/**
 * Pod anti affinity is a group of inter pod anti affinity scheduling rules.
 */
class PodAntiAffinity implements JsonSerializable
{
    /**
     * The scheduler will prefer to schedule pods to nodes that satisfy the
     * anti-affinity expressions specified by this field, but it may choose a node that
     * violates one or more of the expressions. The node that is most preferred is the
     * one with the greatest sum of weights, i.e. for each node that meets all of the
     * scheduling requirements (resource request, requiredDuringScheduling
     * anti-affinity expressions, etc.), compute a sum by iterating through the
     * elements of this field and adding "weight" to the sum if the node has pods which
     * matches the corresponding podAffinityTerm; the node(s) with the highest sum are
     * the most preferred.
     */
    private WeightedPodAffinityTermList $preferredDuringSchedulingIgnoredDuringExecution;

    /**
     * If the anti-affinity requirements specified by this field are not met at
     * scheduling time, the pod will not be scheduled onto the node. If the
     * anti-affinity requirements specified by this field cease to be met at some point
     * during pod execution (e.g. due to a pod label update), the system may or may not
     * try to eventually evict the pod from its node. When there are multiple elements,
     * the lists of nodes corresponding to each podAffinityTerm are intersected, i.e.
     * all terms must be satisfied.
     */
    private PodAffinityTermList $requiredDuringSchedulingIgnoredDuringExecution;

    public function __construct()
    {
        $this->preferredDuringSchedulingIgnoredDuringExecution = new WeightedPodAffinityTermList();
        $this->requiredDuringSchedulingIgnoredDuringExecution = new PodAffinityTermList();
    }

    public function preferredDuringSchedulingIgnoredDuringExecution(): WeightedPodAffinityTermList
    {
        return $this->preferredDuringSchedulingIgnoredDuringExecution;
    }

    public function requiredDuringSchedulingIgnoredDuringExecution(): PodAffinityTermList
    {
        return $this->requiredDuringSchedulingIgnoredDuringExecution;
    }

    public function jsonSerialize(): array
    {
        return [
            'preferredDuringSchedulingIgnoredDuringExecution' => $this->preferredDuringSchedulingIgnoredDuringExecution,
            'requiredDuringSchedulingIgnoredDuringExecution' => $this->requiredDuringSchedulingIgnoredDuringExecution,
        ];
    }
}
