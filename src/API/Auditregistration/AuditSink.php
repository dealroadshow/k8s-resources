<?php 

namespace Dealroadshow\K8S\API\Auditregistration;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\AuditSinkSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * AuditSink represents a cluster level audit sink
 */
class AuditSink implements APIResourceInterface
{
    const API_VERSION = 'auditregistration.k8s.io/v1alpha1';
    const KIND = 'AuditSink';

    private ObjectMeta $metadata;

    /**
     * Spec defines the audit configuration spec
     */
    private AuditSinkSpec $spec;

    public function __construct(AuditSinkSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): AuditSinkSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(AuditSinkSpec $spec): self
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
