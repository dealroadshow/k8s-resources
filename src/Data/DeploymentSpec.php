<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * DeploymentSpec is the specification of the desired behavior of the Deployment.
 */
class DeploymentSpec implements JsonSerializable
{
    /**
     * Minimum number of seconds for which a newly created pod should be ready without
     * any of its container crashing, for it to be considered available. Defaults to 0
     * (pod will be considered available as soon as it is ready)
     *
     * @var int|null
     */
    private ?int $minReadySeconds = null;

    /**
     * Indicates that the deployment is paused.
     *
     * @var bool|null
     */
    private ?bool $paused = null;

    /**
     * The maximum time in seconds for a deployment to make progress before it is
     * considered to be failed. The deployment controller will continue to process
     * failed deployments and a condition with a ProgressDeadlineExceeded reason will
     * be surfaced in the deployment status. Note that progress will not be estimated
     * during the time a deployment is paused. Defaults to 600s.
     *
     * @var int|null
     */
    private ?int $progressDeadlineSeconds = null;

    /**
     * Number of desired pods. This is a pointer to distinguish between explicit zero
     * and not specified. Defaults to 1.
     *
     * @var int|null
     */
    private ?int $replicas = null;

    /**
     * The number of old ReplicaSets to retain to allow rollback. This is a pointer to
     * distinguish between explicit zero and not specified. Defaults to 10.
     *
     * @var int|null
     */
    private ?int $revisionHistoryLimit = null;

    /**
     * Label selector for pods. Existing ReplicaSets whose pods are selected by this
     * will be the ones affected by this deployment. It must match the pod template's
     * labels.
     */
    private LabelSelector $selector;

    /**
     * The deployment strategy to use to replace existing pods with new ones.
     */
    private DeploymentStrategy $strategy;

    /**
     * Template describes the pods that will be created.
     */
    private PodTemplateSpec $template;

    public function __construct()
    {
        $this->selector = new LabelSelector();
        $this->strategy = new DeploymentStrategy();
        $this->template = new PodTemplateSpec();
    }

    /**
     * @return int|null
     */
    public function getMinReadySeconds(): ?int
    {
        return $this->minReadySeconds;
    }

    /**
     * @return bool|null
     */
    public function getPaused(): ?bool
    {
        return $this->paused;
    }

    /**
     * @return int|null
     */
    public function getProgressDeadlineSeconds(): ?int
    {
        return $this->progressDeadlineSeconds;
    }

    /**
     * @return int|null
     */
    public function getReplicas(): ?int
    {
        return $this->replicas;
    }

    /**
     * @return int|null
     */
    public function getRevisionHistoryLimit(): ?int
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

    public function setPaused(bool $paused): self
    {
        $this->paused = $paused;

        return $this;
    }

    public function setProgressDeadlineSeconds(int $progressDeadlineSeconds): self
    {
        $this->progressDeadlineSeconds = $progressDeadlineSeconds;

        return $this;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function setRevisionHistoryLimit(int $revisionHistoryLimit): self
    {
        $this->revisionHistoryLimit = $revisionHistoryLimit;

        return $this;
    }

    public function strategy(): DeploymentStrategy
    {
        return $this->strategy;
    }

    public function template(): PodTemplateSpec
    {
        return $this->template;
    }

    public function jsonSerialize()
    {
        return [
            'minReadySeconds' => $this->minReadySeconds,
            'paused' => $this->paused,
            'progressDeadlineSeconds' => $this->progressDeadlineSeconds,
            'replicas' => $this->replicas,
            'revisionHistoryLimit' => $this->revisionHistoryLimit,
            'selector' => $this->selector,
            'strategy' => $this->strategy,
            'template' => $this->template,
        ];
    }
}
