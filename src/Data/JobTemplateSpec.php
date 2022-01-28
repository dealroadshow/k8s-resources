<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * JobTemplateSpec describes the data a Job should have when created from a
 * template
 */
class JobTemplateSpec implements JsonSerializable
{
    /**
     * Standard object's metadata of the jobs created from this template. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the job. More info:
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
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
