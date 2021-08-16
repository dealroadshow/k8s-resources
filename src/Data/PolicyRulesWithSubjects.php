<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\NonResourcePolicyRuleList;
use Dealroadshow\K8S\Data\Collection\ResourcePolicyRuleList;
use Dealroadshow\K8S\Data\Collection\SubjectList;
use JsonSerializable;

/**
 * PolicyRulesWithSubjects prescribes a test that applies to a request to an
 * apiserver. The test considers the subject making the request, the verb being
 * requested, and the resource to be acted upon. This PolicyRulesWithSubjects
 * matches a request if and only if both (a) at least one member of subjects
 * matches the request and (b) at least one member of resourceRules or
 * nonResourceRules matches the request.
 */
class PolicyRulesWithSubjects implements JsonSerializable
{
    /**
     * `nonResourceRules` is a list of NonResourcePolicyRules that identify matching
     * requests according to their verb and the target non-resource URL.
     */
    private NonResourcePolicyRuleList $nonResourceRules;

    /**
     * `resourceRules` is a slice of ResourcePolicyRules that identify matching
     * requests according to their verb and the target resource. At least one of
     * `resourceRules` and `nonResourceRules` has to be non-empty.
     */
    private ResourcePolicyRuleList $resourceRules;

    /**
     * subjects is the list of normal user, serviceaccount, or group that this rule
     * cares about. There must be at least one member in this slice. A slice that
     * includes both the system:authenticated and system:unauthenticated user groups
     * matches every request. Required.
     */
    private SubjectList $subjects;

    public function __construct()
    {
        $this->nonResourceRules = new NonResourcePolicyRuleList();
        $this->resourceRules = new ResourcePolicyRuleList();
        $this->subjects = new SubjectList();
    }

    public function nonResourceRules(): NonResourcePolicyRuleList
    {
        return $this->nonResourceRules;
    }

    public function resourceRules(): ResourcePolicyRuleList
    {
        return $this->resourceRules;
    }

    public function subjects(): SubjectList
    {
        return $this->subjects;
    }

    public function jsonSerialize(): array
    {
        return [
            'nonResourceRules' => $this->nonResourceRules,
            'resourceRules' => $this->resourceRules,
            'subjects' => $this->subjects,
        ];
    }
}
