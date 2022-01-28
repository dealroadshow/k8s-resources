<?php 

namespace Dealroadshow\K8S\API\Rbac;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\PolicyRuleList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Role is a namespaced, logical grouping of PolicyRules that can be referenced as
 * a unit by a RoleBinding.
 */
class Role implements APIResourceInterface
{
    public const API_VERSION = 'rbac.authorization.k8s.io/v1';
    public const KIND = 'Role';

    /**
     * Standard object's metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Rules holds all the PolicyRules for this Role
     */
    private PolicyRuleList $rules;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->rules = new PolicyRuleList();
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
            'metadata' => $this->metadata,
            'rules' => $this->rules,
        ];
    }
}
