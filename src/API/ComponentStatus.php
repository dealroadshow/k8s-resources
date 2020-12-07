<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\ComponentConditionList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * ComponentStatus (and ComponentStatusList) holds the cluster validation info.
 */
class ComponentStatus implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'ComponentStatus';

    /**
     * List of component conditions observed
     */
    private ComponentConditionList $conditions;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    public function __construct()
    {
        $this->conditions = new ComponentConditionList();
        $this->metadata = new ObjectMeta();
    }

    public function conditions(): ComponentConditionList
    {
        return $this->conditions;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'conditions' => $this->conditions,
            'metadata' => $this->metadata,
        ];
    }
}
