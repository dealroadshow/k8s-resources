<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Admissionregistration;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ValidatingAdmissionPolicySpec;

/**
 * ValidatingAdmissionPolicy describes the definition of an admission validation
 * policy that accepts or rejects an object without changing it.
 */
class ValidatingAdmissionPolicy implements APIResourceInterface
{
    public const API_VERSION = 'admissionregistration.k8s.io/v1alpha1';
    public const KIND = 'ValidatingAdmissionPolicy';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the ValidatingAdmissionPolicy.
     */
    private ValidatingAdmissionPolicySpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ValidatingAdmissionPolicySpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): ValidatingAdmissionPolicySpec
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
