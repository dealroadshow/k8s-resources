<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ObjectReference;

/**
 * Binding ties one object to another; for example, a pod is bound to a node by a
 * scheduler. Deprecated in 1.7, please use the bindings subresource of pods
 * instead.
 */
class Binding implements APIResourceInterface
{
    public const API_VERSION = 'v1';
    public const KIND = 'Binding';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * The target object that you want to bind to the standard object.
     */
    private ObjectReference $target;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->target = new ObjectReference();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function target(): ObjectReference
    {
        return $this->target;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'target' => $this->target,
        ];
    }
}
