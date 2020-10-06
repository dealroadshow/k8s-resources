<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * JobSpec describes how the job execution will look like.
 */
class JobSpec implements JsonSerializable
{
    /**
     * Specifies the duration in seconds relative to the startTime that the job may be
     * active before the system tries to terminate it; value must be positive integer
     *
     * @var int|null
     */
    private ?int $activeDeadlineSeconds = null;

    /**
     * Specifies the number of retries before marking this job failed. Defaults to 6
     *
     * @var int|null
     */
    private ?int $backoffLimit = null;

    /**
     * Specifies the desired number of successfully finished pods the job should be run
     * with.  Setting to nil means that the success of any pod signals the success of
     * all pods, and allows parallelism to have any positive value.  Setting to 1 means
     * that parallelism is limited to 1 and the success of that pod signals the success
     * of the job. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     *
     * @var int|null
     */
    private ?int $completions = null;

    /**
     * manualSelector controls generation of pod labels and pod selectors. Leave
     * `manualSelector` unset unless you are certain what you are doing. When false or
     * unset, the system pick labels unique to this job and appends those labels to the
     * pod template.  When true, the user is responsible for picking unique labels and
     * specifying the selector.  Failure to pick a unique label may cause this and
     * other jobs to not function correctly.  However, You may see
     * `manualSelector=true` in jobs that were created with the old
     * `extensions/v1beta1` API. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/#specifying-your-own-pod-selector
     *
     * @var bool|null
     */
    private ?bool $manualSelector = null;

    /**
     * Specifies the maximum desired number of pods the job should run at any given
     * time. The actual number of pods running in steady state will be less than this
     * number when ((.spec.completions - .status.successful) < .spec.parallelism), i.e.
     * when the work left to do is less than max parallelism. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     *
     * @var int|null
     */
    private ?int $parallelism = null;

    /**
     * A label query over pods that should match the pod count. Normally, the system
     * sets this field for you. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels/#label-selectors
     */
    private LabelSelector $selector;

    /**
     * Describes the pod that will be created when executing a job. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     */
    private PodTemplateSpec $template;

    /**
     * ttlSecondsAfterFinished limits the lifetime of a Job that has finished execution
     * (either Complete or Failed). If this field is set, ttlSecondsAfterFinished after
     * the Job finishes, it is eligible to be automatically deleted. When the Job is
     * being deleted, its lifecycle guarantees (e.g. finalizers) will be honored. If
     * this field is unset, the Job won't be automatically deleted. If this field is
     * set to zero, the Job becomes eligible to be deleted immediately after it
     * finishes. This field is alpha-level and is only honored by servers that enable
     * the TTLAfterFinished feature.
     *
     * @var int|null
     */
    private ?int $ttlSecondsAfterFinished = null;

    public function __construct()
    {
        $this->selector = new LabelSelector();
        $this->template = new PodTemplateSpec();
    }

    /**
     * @return int|null
     */
    public function getActiveDeadlineSeconds(): ?int
    {
        return $this->activeDeadlineSeconds;
    }

    /**
     * @return int|null
     */
    public function getBackoffLimit(): ?int
    {
        return $this->backoffLimit;
    }

    /**
     * @return int|null
     */
    public function getCompletions(): ?int
    {
        return $this->completions;
    }

    /**
     * @return bool|null
     */
    public function getManualSelector(): ?bool
    {
        return $this->manualSelector;
    }

    /**
     * @return int|null
     */
    public function getParallelism(): ?int
    {
        return $this->parallelism;
    }

    /**
     * @return int|null
     */
    public function getTtlSecondsAfterFinished(): ?int
    {
        return $this->ttlSecondsAfterFinished;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function setActiveDeadlineSeconds(int $activeDeadlineSeconds): self
    {
        $this->activeDeadlineSeconds = $activeDeadlineSeconds;

        return $this;
    }

    public function setBackoffLimit(int $backoffLimit): self
    {
        $this->backoffLimit = $backoffLimit;

        return $this;
    }

    public function setCompletions(int $completions): self
    {
        $this->completions = $completions;

        return $this;
    }

    public function setManualSelector(bool $manualSelector): self
    {
        $this->manualSelector = $manualSelector;

        return $this;
    }

    public function setParallelism(int $parallelism): self
    {
        $this->parallelism = $parallelism;

        return $this;
    }

    public function setTtlSecondsAfterFinished(int $ttlSecondsAfterFinished): self
    {
        $this->ttlSecondsAfterFinished = $ttlSecondsAfterFinished;

        return $this;
    }

    public function template(): PodTemplateSpec
    {
        return $this->template;
    }

    public function jsonSerialize()
    {
        return [
            'activeDeadlineSeconds' => $this->activeDeadlineSeconds,
            'backoffLimit' => $this->backoffLimit,
            'completions' => $this->completions,
            'manualSelector' => $this->manualSelector,
            'parallelism' => $this->parallelism,
            'selector' => $this->selector,
            'template' => $this->template,
            'ttlSecondsAfterFinished' => $this->ttlSecondsAfterFinished,
        ];
    }
}
