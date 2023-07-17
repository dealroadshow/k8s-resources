<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ValidationList;
use JsonSerializable;

/**
 * ValidatingAdmissionPolicySpec is the specification of the desired behavior of
 * the AdmissionPolicy.
 */
class ValidatingAdmissionPolicySpec implements JsonSerializable
{
    /**
     * FailurePolicy defines how to handle failures for the admission policy. Failures
     * can occur from invalid or mis-configured policy definitions or bindings. A
     * policy is invalid if spec.paramKind refers to a non-existent Kind. A binding is
     * invalid if spec.paramRef.name refers to a non-existent resource. Allowed values
     * are Ignore or Fail. Defaults to Fail.
     */
    private string|null $failurePolicy = null;

    /**
     * MatchConstraints specifies what resources this policy is designed to validate.
     * The AdmissionPolicy cares about a request if it matches _all_ Constraints.
     * However, in order to prevent clusters from being put into an unstable state that
     * cannot be recovered from via the API ValidatingAdmissionPolicy cannot match
     * ValidatingAdmissionPolicy and ValidatingAdmissionPolicyBinding. Required.
     */
    private MatchResources $matchConstraints;

    /**
     * ParamKind specifies the kind of resources used to parameterize this policy. If
     * absent, there are no parameters for this policy and the param CEL variable will
     * not be provided to validation expressions. If ParamKind refers to a non-existent
     * kind, this policy definition is mis-configured and the FailurePolicy is applied.
     * If paramKind is specified but paramRef is unset in
     * ValidatingAdmissionPolicyBinding, the params variable will be null.
     */
    private ParamKind $paramKind;

    /**
     * Validations contain CEL expressions which is used to apply the validation. A
     * minimum of one validation is required for a policy definition. Required.
     */
    private ValidationList $validations;

    public function __construct()
    {
        $this->matchConstraints = new MatchResources();
        $this->paramKind = new ParamKind();
        $this->validations = new ValidationList();
    }

    public function getFailurePolicy(): string|null
    {
        return $this->failurePolicy;
    }

    public function matchConstraints(): MatchResources
    {
        return $this->matchConstraints;
    }

    public function paramKind(): ParamKind
    {
        return $this->paramKind;
    }

    public function setFailurePolicy(string $failurePolicy): self
    {
        $this->failurePolicy = $failurePolicy;

        return $this;
    }

    public function validations(): ValidationList
    {
        return $this->validations;
    }

    public function jsonSerialize(): array
    {
        return [
            'failurePolicy' => $this->failurePolicy,
            'matchConstraints' => $this->matchConstraints,
            'paramKind' => $this->paramKind,
            'validations' => $this->validations,
        ];
    }
}
