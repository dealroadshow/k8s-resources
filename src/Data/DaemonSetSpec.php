<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * DaemonSetSpec is the specification of a daemon set.
 */
class DaemonSetSpec implements JsonSerializable
{
    /**
     * The minimum number of seconds for which a newly created DaemonSet pod should be
     * ready without any of its container crashing, for it to be considered available.
     * Defaults to 0 (pod will be considered available as soon as it is ready).
     */
    private int|null $minReadySeconds = null;

    /**
     * The number of old history to retain to allow rollback. This is a pointer to
     * distinguish between explicit zero and not specified. Defaults to 10.
     */
    private int|null $revisionHistoryLimit = null;

    /**
     * A label query over pods that are managed by the daemon set. Must match in order
     * to be controlled. It must match the pod template's labels. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels/#label-selectors
     */
    private LabelSelector $selector;

    /**
     * An object that describes the pod that will be created. The DaemonSet will create
     * exactly one copy of this pod on every node that matches the template's node
     * selector (or on every node if no node selector is specified). More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/replicationcontroller#pod-template
     */
    private PodTemplateSpec $template;

    /**
     * An update strategy to replace existing DaemonSet pods with new pods.
     */
    private DaemonSetUpdateStrategy $updateStrategy;

    public function __construct()
    {
        $this->selector = new LabelSelector();
        $this->template = new PodTemplateSpec();
        $this->updateStrategy = new DaemonSetUpdateStrategy();
    }

    public function getMinReadySeconds(): int|null
    {
        return $this->minReadySeconds;
    }

    public function getRevisionHistoryLimit(): int|null
    {
        return $this->revisionHistoryLimit;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function setMinReadySeconds(int $minReadySeconds): self
    {
        $this->minReadySeconds = $minReadySeconds;

        return $this;
    }

    public function setRevisionHistoryLimit(int $revisionHistoryLimit): self
    {
        $this->revisionHistoryLimit = $revisionHistoryLimit;

        return $this;
    }

    public function template(): PodTemplateSpec
    {
        return $this->template;
    }

    public function updateStrategy(): DaemonSetUpdateStrategy
    {
        return $this->updateStrategy;
    }

    public function jsonSerialize(): array
    {
        return [
            'minReadySeconds' => $this->minReadySeconds,
            'revisionHistoryLimit' => $this->revisionHistoryLimit,
            'selector' => $this->selector,
            'template' => $this->template,
            'updateStrategy' => $this->updateStrategy,
        ];
    }
}
