<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * Defines a set of pods (namely those matching the labelSelector relative to the
 * given namespace(s)) that this pod should be co-located (affinity) or not
 * co-located (anti-affinity) with, where co-located is defined as running on a
 * node whose value of the label with key <topologyKey> matches that of any node on
 * which a pod of the set of pods is running
 */
class PodAffinityTerm implements JsonSerializable
{
    /**
     * A label query over a set of resources, in this case pods.
     */
    private LabelSelector $labelSelector;

    /**
     * A label query over the set of namespaces that the term applies to. The term is
     * applied to the union of the namespaces selected by this field and the ones
     * listed in the namespaces field. null selector and null or empty namespaces list
     * means "this pod's namespace". An empty selector ({}) matches all namespaces.
     * This field is beta-level and is only honored when PodAffinityNamespaceSelector
     * feature is enabled.
     */
    private LabelSelector $namespaceSelector;

    /**
     * namespaces specifies a static list of namespace names that the term applies to.
     * The term is applied to the union of the namespaces listed in this field and the
     * ones selected by namespaceSelector. null or empty namespaces list and null
     * namespaceSelector means "this pod's namespace"
     */
    private StringList $namespaces;

    /**
     * This pod should be co-located (affinity) or not co-located (anti-affinity) with
     * the pods matching the labelSelector in the specified namespaces, where
     * co-located is defined as running on a node whose value of the label with key
     * topologyKey matches that of any node on which any of the selected pods is
     * running. Empty topologyKey is not allowed.
     */
    private string $topologyKey;

    public function __construct(string $topologyKey)
    {
        $this->labelSelector = new LabelSelector();
        $this->namespaceSelector = new LabelSelector();
        $this->namespaces = new StringList();
        $this->topologyKey = $topologyKey;
    }

    public function getTopologyKey(): string
    {
        return $this->topologyKey;
    }

    public function labelSelector(): LabelSelector
    {
        return $this->labelSelector;
    }

    public function namespaceSelector(): LabelSelector
    {
        return $this->namespaceSelector;
    }

    public function namespaces(): StringList
    {
        return $this->namespaces;
    }

    public function setTopologyKey(string $topologyKey): self
    {
        $this->topologyKey = $topologyKey;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'labelSelector' => $this->labelSelector,
            'namespaceSelector' => $this->namespaceSelector,
            'namespaces' => $this->namespaces,
            'topologyKey' => $this->topologyKey,
        ];
    }
}
