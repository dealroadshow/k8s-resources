<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * PodSchedulingSpec describes where resources for the Pod are needed.
 */
class PodSchedulingSpec implements JsonSerializable
{
    /**
     * PotentialNodes lists nodes where the Pod might be able to run.
     *
     * The size of this field is limited to 128. This is large enough for many
     * clusters. Larger clusters may need more attempts to find a node that suits all
     * pending resources. This may get increased in the future, but not reduced.
     */
    private StringList $potentialNodes;

    /**
     * SelectedNode is the node for which allocation of ResourceClaims that are
     * referenced by the Pod and that use "WaitForFirstConsumer" allocation is to be
     * attempted.
     */
    private string|null $selectedNode = null;

    public function __construct()
    {
        $this->potentialNodes = new StringList();
    }

    public function getSelectedNode(): string|null
    {
        return $this->selectedNode;
    }

    public function potentialNodes(): StringList
    {
        return $this->potentialNodes;
    }

    public function setSelectedNode(string $selectedNode): self
    {
        $this->selectedNode = $selectedNode;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'potentialNodes' => $this->potentialNodes,
            'selectedNode' => $this->selectedNode,
        ];
    }
}
