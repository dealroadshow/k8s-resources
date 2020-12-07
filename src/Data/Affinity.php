<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Affinity is a group of affinity scheduling rules.
 */
class Affinity implements JsonSerializable
{
    /**
     * Describes node affinity scheduling rules for the pod.
     */
    private NodeAffinity $nodeAffinity;

    /**
     * Describes pod affinity scheduling rules (e.g. co-locate this pod in the same
     * node, zone, etc. as some other pod(s)).
     */
    private PodAffinity $podAffinity;

    /**
     * Describes pod anti-affinity scheduling rules (e.g. avoid putting this pod in the
     * same node, zone, etc. as some other pod(s)).
     */
    private PodAntiAffinity $podAntiAffinity;

    public function __construct()
    {
        $this->nodeAffinity = new NodeAffinity();
        $this->podAffinity = new PodAffinity();
        $this->podAntiAffinity = new PodAntiAffinity();
    }

    public function nodeAffinity(): NodeAffinity
    {
        return $this->nodeAffinity;
    }

    public function podAffinity(): PodAffinity
    {
        return $this->podAffinity;
    }

    public function podAntiAffinity(): PodAntiAffinity
    {
        return $this->podAntiAffinity;
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeAffinity' => $this->nodeAffinity,
            'podAffinity' => $this->podAffinity,
            'podAntiAffinity' => $this->podAntiAffinity,
        ];
    }
}
