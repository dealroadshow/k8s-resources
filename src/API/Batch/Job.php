<?php 

namespace Dealroadshow\K8S\API\Batch;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\JobSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Job represents the configuration of a single job.
 */
class Job implements APIResourceInterface
{
    const API_VERSION = 'batch/v1';
    const KIND = 'Job';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of a job. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private JobSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new JobSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): JobSpec
    {
        return $this->spec;
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
