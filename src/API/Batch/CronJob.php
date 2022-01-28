<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Batch;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\CronJobSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * CronJob represents the configuration of a single cron job.
 */
class CronJob implements APIResourceInterface
{
    public const API_VERSION = 'batch/v1';
    public const KIND = 'CronJob';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of a cron job, including the schedule.
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private CronJobSpec $spec;

    public function __construct(CronJobSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): CronJobSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(CronJobSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
