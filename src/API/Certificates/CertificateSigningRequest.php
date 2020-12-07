<?php 

namespace Dealroadshow\K8S\API\Certificates;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\CertificateSigningRequestSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Describes a certificate signing request
 */
class CertificateSigningRequest implements APIResourceInterface
{
    const API_VERSION = 'certificates.k8s.io/v1beta1';
    const KIND = 'CertificateSigningRequest';

    private ObjectMeta $metadata;

    /**
     * The certificate request itself and any additional information.
     */
    private CertificateSigningRequestSpec $spec;

    public function __construct(CertificateSigningRequestSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): CertificateSigningRequestSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(CertificateSigningRequestSpec $spec): self
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
