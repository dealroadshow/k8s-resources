<?php 

namespace Dealroadshow\K8S\API\Apps;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\DaemonSetSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * DaemonSet represents the configuration of a daemon set.
 */
class DaemonSet implements APIResourceInterface
{
    public const API_VERSION = 'apps/v1';
    public const KIND = 'DaemonSet';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * The desired behavior of this daemon set. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private DaemonSetSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new DaemonSetSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): DaemonSetSpec
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
