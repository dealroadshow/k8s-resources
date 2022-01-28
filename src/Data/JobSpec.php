<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * JobSpec describes how the job execution will look like.
 */
class JobSpec implements JsonSerializable
{
    /**
     * Specifies the duration in seconds relative to the startTime that the job may be
     * continuously active before the system tries to terminate it; value must be
     * positive integer. If a Job is suspended (at creation or through an update), this
     * timer will effectively be stopped and reset when the Job is resumed again.
     */
    private int|null $activeDeadlineSeconds = null;

    /**
     * Specifies the number of retries before marking this job failed. Defaults to 6
     */
    private int|null $backoffLimit = null;

    /**
     * CompletionMode specifies how Pod completions are tracked. It can be `NonIndexed`
     * (default) or `Indexed`.
     *
     * `NonIndexed` means that the Job is considered complete when there have been
     * .spec.completions successfully completed Pods. Each Pod completion is homologous
     * to each other.
     *
     * `Indexed` means that the Pods of a Job get an associated completion index from 0
     * to (.spec.completions - 1), available in the annotation
     * batch.kubernetes.io/job-completion-index. The Job is considered complete when
     * there is one successfully completed Pod for each index. When value is `Indexed`,
     * .spec.completions must be specified and `.spec.parallelism` must be less than or
     * equal to 10^5. In addition, The Pod name takes the form
     * `$(job-name)-$(index)-$(random-string)`, the Pod hostname takes the form
     * `$(job-name)-$(index)`.
     *
     * This field is beta-level. More completion modes can be added in the future. If
     * the Job controller observes a mode that it doesn't recognize, the controller
     * skips updates for the Job.
     */
    private string|null $completionMode = null;

    /**
     * Specifies the desired number of successfully finished pods the job should be run
     * with.  Setting to nil means that the success of any pod signals the success of
     * all pods, and allows parallelism to have any positive value.  Setting to 1 means
     * that parallelism is limited to 1 and the success of that pod signals the success
     * of the job. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     */
    private int|null $completions = null;

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
     */
    private bool|null $manualSelector = null;

    /**
     * Specifies the maximum desired number of pods the job should run at any given
     * time. The actual number of pods running in steady state will be less than this
     * number when ((.spec.completions - .status.successful) < .spec.parallelism), i.e.
     * when the work left to do is less than max parallelism. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     */
    private int|null $parallelism = null;

    /**
     * A label query over pods that should match the pod count. Normally, the system
     * sets this field for you. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels/#label-selectors
     */
    private LabelSelector $selector;

    /**
     * Suspend specifies whether the Job controller should create Pods or not. If a Job
     * is created with suspend set to true, no Pods are created by the Job controller.
     * If a Job is suspended after creation (i.e. the flag goes from false to true),
     * the Job controller will delete all active Pods associated with this Job. Users
     * must design their workload to gracefully handle this. Suspending a Job will
     * reset the StartTime field of the Job, effectively resetting the
     * ActiveDeadlineSeconds timer too. Defaults to false.
     *
     * This field is beta-level, gated by SuspendJob feature flag (enabled by default).
     */
    private bool|null $suspend = null;

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
     * finishes.
     */
    private int|null $ttlSecondsAfterFinished = null;

    public function __construct()
    {
        $this->selector = new LabelSelector();
        $this->template = new PodTemplateSpec();
    }

    public function getActiveDeadlineSeconds(): int|null
    {
        return $this->activeDeadlineSeconds;
    }

    public function getBackoffLimit(): int|null
    {
        return $this->backoffLimit;
    }

    public function getCompletionMode(): string|null
    {
        return $this->completionMode;
    }

    public function getCompletions(): int|null
    {
        return $this->completions;
    }

    public function getManualSelector(): bool|null
    {
        return $this->manualSelector;
    }

    public function getParallelism(): int|null
    {
        return $this->parallelism;
    }

    public function getSuspend(): bool|null
    {
        return $this->suspend;
    }

    public function getTtlSecondsAfterFinished(): int|null
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

    public function setCompletionMode(string $completionMode): self
    {
        $this->completionMode = $completionMode;

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

    public function setSuspend(bool $suspend): self
    {
        $this->suspend = $suspend;

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

    public function jsonSerialize(): array
    {
        return [
            'activeDeadlineSeconds' => $this->activeDeadlineSeconds,
            'backoffLimit' => $this->backoffLimit,
            'completionMode' => $this->completionMode,
            'completions' => $this->completions,
            'manualSelector' => $this->manualSelector,
            'parallelism' => $this->parallelism,
            'selector' => $this->selector,
            'suspend' => $this->suspend,
            'template' => $this->template,
            'ttlSecondsAfterFinished' => $this->ttlSecondsAfterFinished,
        ];
    }
}
