<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\PodFailurePolicyRuleList;
use JsonSerializable;

/**
 * PodFailurePolicy describes how failed pods influence the backoffLimit.
 */
class PodFailurePolicy implements JsonSerializable
{
    /**
     * A list of pod failure policy rules. The rules are evaluated in order. Once a
     * rule matches a Pod failure, the remaining of the rules are ignored. When no rule
     * matches the Pod failure, the default handling applies - the counter of pod
     * failures is incremented and it is checked against the backoffLimit. At most 20
     * elements are allowed.
     */
    private PodFailurePolicyRuleList $rules;

    public function __construct()
    {
        $this->rules = new PodFailurePolicyRuleList();
    }

    public function rules(): PodFailurePolicyRuleList
    {
        return $this->rules;
    }

    public function jsonSerialize(): array
    {
        return [
            'rules' => $this->rules,
        ];
    }
}
