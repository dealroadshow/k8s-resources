<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * CronJobSpec describes how the job execution will look like and when it will
 * actually run.
 */
class CronJobSpec implements JsonSerializable
{
    /**
     * Specifies how to treat concurrent executions of a Job. Valid values are: -
     * "Allow" (default): allows CronJobs to run concurrently; - "Forbid": forbids
     * concurrent runs, skipping next run if previous run hasn't finished yet; -
     * "Replace": cancels currently running job and replaces it with a new one
     */
    private string|null $concurrencyPolicy = null;

    /**
     * The number of failed finished jobs to retain. Value must be non-negative
     * integer. Defaults to 1.
     */
    private int|null $failedJobsHistoryLimit = null;

    /**
     * Specifies the job that will be created when executing a CronJob.
     */
    private JobTemplateSpec $jobTemplate;

    /**
     * The schedule in Cron format, see https://en.wikipedia.org/wiki/Cron.
     */
    private string $schedule;

    /**
     * Optional deadline in seconds for starting the job if it misses scheduled time
     * for any reason.  Missed jobs executions will be counted as failed ones.
     */
    private int|null $startingDeadlineSeconds = null;

    /**
     * The number of successful finished jobs to retain. Value must be non-negative
     * integer. Defaults to 3.
     */
    private int|null $successfulJobsHistoryLimit = null;

    /**
     * This flag tells the controller to suspend subsequent executions, it does not
     * apply to already started executions.  Defaults to false.
     */
    private bool|null $suspend = null;

    public function __construct(string $schedule)
    {
        $this->jobTemplate = new JobTemplateSpec();
        $this->schedule = $schedule;
    }

    public function getConcurrencyPolicy(): string|null
    {
        return $this->concurrencyPolicy;
    }

    public function getFailedJobsHistoryLimit(): int|null
    {
        return $this->failedJobsHistoryLimit;
    }

    public function getSchedule(): string
    {
        return $this->schedule;
    }

    public function getStartingDeadlineSeconds(): int|null
    {
        return $this->startingDeadlineSeconds;
    }

    public function getSuccessfulJobsHistoryLimit(): int|null
    {
        return $this->successfulJobsHistoryLimit;
    }

    public function getSuspend(): bool|null
    {
        return $this->suspend;
    }

    public function jobTemplate(): JobTemplateSpec
    {
        return $this->jobTemplate;
    }

    public function setConcurrencyPolicy(string $concurrencyPolicy): self
    {
        $this->concurrencyPolicy = $concurrencyPolicy;

        return $this;
    }

    public function setFailedJobsHistoryLimit(int $failedJobsHistoryLimit): self
    {
        $this->failedJobsHistoryLimit = $failedJobsHistoryLimit;

        return $this;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function setStartingDeadlineSeconds(int $startingDeadlineSeconds): self
    {
        $this->startingDeadlineSeconds = $startingDeadlineSeconds;

        return $this;
    }

    public function setSuccessfulJobsHistoryLimit(int $successfulJobsHistoryLimit): self
    {
        $this->successfulJobsHistoryLimit = $successfulJobsHistoryLimit;

        return $this;
    }

    public function setSuspend(bool $suspend): self
    {
        $this->suspend = $suspend;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'concurrencyPolicy' => $this->concurrencyPolicy,
            'failedJobsHistoryLimit' => $this->failedJobsHistoryLimit,
            'jobTemplate' => $this->jobTemplate,
            'schedule' => $this->schedule,
            'startingDeadlineSeconds' => $this->startingDeadlineSeconds,
            'successfulJobsHistoryLimit' => $this->successfulJobsHistoryLimit,
            'suspend' => $this->suspend,
        ];
    }
}
