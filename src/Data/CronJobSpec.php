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
     *
     * @var string|null
     */
    private ?string $concurrencyPolicy = null;

    /**
     * The number of failed finished jobs to retain. This is a pointer to distinguish
     * between explicit zero and not specified. Defaults to 1.
     *
     * @var int|null
     */
    private ?int $failedJobsHistoryLimit = null;

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
     *
     * @var int|null
     */
    private ?int $startingDeadlineSeconds = null;

    /**
     * The number of successful finished jobs to retain. This is a pointer to
     * distinguish between explicit zero and not specified. Defaults to 3.
     *
     * @var int|null
     */
    private ?int $successfulJobsHistoryLimit = null;

    /**
     * This flag tells the controller to suspend subsequent executions, it does not
     * apply to already started executions.  Defaults to false.
     *
     * @var bool|null
     */
    private ?bool $suspend = null;

    public function __construct(string $schedule)
    {
        $this->jobTemplate = new JobTemplateSpec();
        $this->schedule = $schedule;
    }

    /**
     * @return string|null
     */
    public function getConcurrencyPolicy(): ?string
    {
        return $this->concurrencyPolicy;
    }

    /**
     * @return int|null
     */
    public function getFailedJobsHistoryLimit(): ?int
    {
        return $this->failedJobsHistoryLimit;
    }

    public function getSchedule(): string
    {
        return $this->schedule;
    }

    /**
     * @return int|null
     */
    public function getStartingDeadlineSeconds(): ?int
    {
        return $this->startingDeadlineSeconds;
    }

    /**
     * @return int|null
     */
    public function getSuccessfulJobsHistoryLimit(): ?int
    {
        return $this->successfulJobsHistoryLimit;
    }

    /**
     * @return bool|null
     */
    public function getSuspend(): ?bool
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

    public function jsonSerialize()
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
