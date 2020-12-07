<?php 

namespace Dealroadshow\K8S\API\Rbac;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\AggregationRule;
use Dealroadshow\K8S\Data\Collection\PolicyRuleList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * ClusterRole is a cluster level, logical grouping of PolicyRules that can be
 * referenced as a unit by a RoleBinding or ClusterRoleBinding.
 */
class ClusterRole implements APIResourceInterface
{
    const API_VERSION = 'rbac.authorization.k8s.io/v1';
    const KIND = 'ClusterRole';

    /**
     * AggregationRule is an optional field that describes how to build the Rules for
     * this ClusterRole. If AggregationRule is set, then the Rules are controller
     * managed and direct changes to Rules will be stomped by the controller.
     */
    private AggregationRule $aggregationRule;

    /**
     * Standard object's metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Rules holds all the PolicyRules for this ClusterRole
     */
    private PolicyRuleList $rules;

    public function __construct()
    {
        $this->aggregationRule = new AggregationRule();
        $this->metadata = new ObjectMeta();
        $this->rules = new PolicyRuleList();
    }

    public function aggregationRule(): AggregationRule
    {
        return $this->aggregationRule;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function rules(): PolicyRuleList
    {
        return $this->rules;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'aggregationRule' => $this->aggregationRule,
            'metadata' => $this->metadata,
            'rules' => $this->rules,
        ];
    }
}
