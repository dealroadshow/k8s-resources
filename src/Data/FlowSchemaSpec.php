<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\PolicyRulesWithSubjectsList;
use JsonSerializable;

/**
 * FlowSchemaSpec describes how the FlowSchema's specification looks like.
 */
class FlowSchemaSpec implements JsonSerializable
{
    /**
     * `distinguisherMethod` defines how to compute the flow distinguisher for requests
     * that match this schema. `nil` specifies that the distinguisher is disabled and
     * thus will always be the empty string.
     */
    private FlowDistinguisherMethod|null $distinguisherMethod = null;

    /**
     * `matchingPrecedence` is used to choose among the FlowSchemas that match a given
     * request. The chosen FlowSchema is among those with the numerically lowest (which
     * we take to be logically highest) MatchingPrecedence.  Each MatchingPrecedence
     * value must be ranged in [1,10000]. Note that if the precedence is not specified,
     * it will be set to 1000 as default.
     */
    private int|null $matchingPrecedence = null;

    /**
     * `priorityLevelConfiguration` should reference a PriorityLevelConfiguration in
     * the cluster. If the reference cannot be resolved, the FlowSchema will be ignored
     * and marked as invalid in its status. Required.
     */
    private PriorityLevelConfigurationReference $priorityLevelConfiguration;

    /**
     * `rules` describes which requests will match this flow schema. This FlowSchema
     * matches a request if and only if at least one member of rules matches the
     * request. if it is an empty slice, there will be no requests matching the
     * FlowSchema.
     */
    private PolicyRulesWithSubjectsList $rules;

    public function __construct(PriorityLevelConfigurationReference $priorityLevelConfiguration)
    {
        $this->priorityLevelConfiguration = $priorityLevelConfiguration;
        $this->rules = new PolicyRulesWithSubjectsList();
    }

    public function getDistinguisherMethod(): FlowDistinguisherMethod|null
    {
        return $this->distinguisherMethod;
    }

    public function getMatchingPrecedence(): int|null
    {
        return $this->matchingPrecedence;
    }

    public function getPriorityLevelConfiguration(): PriorityLevelConfigurationReference
    {
        return $this->priorityLevelConfiguration;
    }

    public function rules(): PolicyRulesWithSubjectsList
    {
        return $this->rules;
    }

    public function setDistinguisherMethod(FlowDistinguisherMethod $distinguisherMethod): self
    {
        $this->distinguisherMethod = $distinguisherMethod;

        return $this;
    }

    public function setMatchingPrecedence(int $matchingPrecedence): self
    {
        $this->matchingPrecedence = $matchingPrecedence;

        return $this;
    }

    public function setPriorityLevelConfiguration(PriorityLevelConfigurationReference $priorityLevelConfiguration): self
    {
        $this->priorityLevelConfiguration = $priorityLevelConfiguration;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'distinguisherMethod' => $this->distinguisherMethod,
            'matchingPrecedence' => $this->matchingPrecedence,
            'priorityLevelConfiguration' => $this->priorityLevelConfiguration,
            'rules' => $this->rules,
        ];
    }
}
