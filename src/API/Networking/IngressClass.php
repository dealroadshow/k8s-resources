<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Networking;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\IngressClassSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * IngressClass represents the class of the Ingress, referenced by the Ingress
 * Spec. The `ingressclass.kubernetes.io/is-default-class` annotation can be used
 * to indicate that an IngressClass should be considered default. When a single
 * IngressClass resource has this annotation set to true, new Ingress resources
 * without a class specified will be assigned this default class.
 */
class IngressClass implements APIResourceInterface
{
    public const API_VERSION = 'networking.k8s.io/v1';
    public const KIND = 'IngressClass';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec is the desired state of the IngressClass. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private IngressClassSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new IngressClassSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): IngressClassSpec
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
