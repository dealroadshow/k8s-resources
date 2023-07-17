<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Admissionregistration;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ValidatingAdmissionPolicyBindingSpec;

/**
 * ValidatingAdmissionPolicyBinding binds the ValidatingAdmissionPolicy with
 * paramerized resources. ValidatingAdmissionPolicyBinding and parameter CRDs
 * together define how cluster administrators configure policies for clusters.
 */
class ValidatingAdmissionPolicyBinding implements APIResourceInterface
{
    public const API_VERSION = 'admissionregistration.k8s.io/v1alpha1';
    public const KIND = 'ValidatingAdmissionPolicyBinding';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the ValidatingAdmissionPolicyBinding.
     */
    private ValidatingAdmissionPolicyBindingSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ValidatingAdmissionPolicyBindingSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): ValidatingAdmissionPolicyBindingSpec
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
