<?php 

namespace Dealroadshow\K8S\API\Certificates;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\CertificateSigningRequestSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * CertificateSigningRequest objects provide a mechanism to obtain x509
 * certificates by submitting a certificate signing request, and having it
 * asynchronously approved and issued.
 *
 * Kubelets use this API to obtain:
 *  1. client certificates to authenticate to kube-apiserver (with the
 * "kubernetes.io/kube-apiserver-client-kubelet" signerName).
 *  2. serving certificates for TLS endpoints kube-apiserver can connect to
 * securely (with the "kubernetes.io/kubelet-serving" signerName).
 *
 * This API can be used to request client certificates to authenticate to
 * kube-apiserver (with the "kubernetes.io/kube-apiserver-client" signerName), or
 * to obtain certificates from custom non-Kubernetes signers.
 */
class CertificateSigningRequest implements APIResourceInterface
{
    public const API_VERSION = 'certificates.k8s.io/v1';
    public const KIND = 'CertificateSigningRequest';

    private ObjectMeta $metadata;

    /**
     * spec contains the certificate request, and is immutable after creation. Only the
     * request, signerName, and usages fields can be set on creation. Other fields are
     * derived by Kubernetes and cannot be modified by users.
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
