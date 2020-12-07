<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringMap;
use Dealroadshow\K8S\Data\Collection\TolerationList;
use JsonSerializable;

/**
 * Scheduling specifies the scheduling constraints for nodes supporting a
 * RuntimeClass.
 */
class Scheduling implements JsonSerializable
{
    /**
     * nodeSelector lists labels that must be present on nodes that support this
     * RuntimeClass. Pods using this RuntimeClass can only be scheduled to a node
     * matched by this selector. The RuntimeClass nodeSelector is merged with a pod's
     * existing nodeSelector. Any conflicts will cause the pod to be rejected in
     * admission.
     */
    private StringMap $nodeSelector;

    /**
     * tolerations are appended (excluding duplicates) to pods running with this
     * RuntimeClass during admission, effectively unioning the set of nodes tolerated
     * by the pod and the RuntimeClass.
     */
    private TolerationList $tolerations;

    public function __construct()
    {
        $this->nodeSelector = new StringMap();
        $this->tolerations = new TolerationList();
    }

    public function nodeSelector(): StringMap
    {
        return $this->nodeSelector;
    }

    public function tolerations(): TolerationList
    {
        return $this->tolerations;
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeSelector' => $this->nodeSelector,
            'tolerations' => $this->tolerations,
        ];
    }
}
