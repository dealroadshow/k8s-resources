<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Validation specifies the CEL expression which is used to apply the validation.
 */
class Validation implements JsonSerializable
{
    /**
     * Expression represents the expression which will be evaluated by CEL. ref:
     * https://github.com/google/cel-spec CEL expressions have access to the contents
     * of the Admission request/response, organized into CEL variables as well as some
     * other useful variables:
     *
     * 'object' - The object from the incoming request. The value is null for DELETE
     * requests. 'oldObject' - The existing object. The value is null for CREATE
     * requests. 'request' - Attributes of the admission
     * request([ref](/pkg/apis/admission/types.go#AdmissionRequest)). 'params' -
     * Parameter resource referred to by the policy binding being evaluated. Only
     * populated if the policy has a ParamKind.
     *
     * The `apiVersion`, `kind`, `metadata.name` and `metadata.generateName` are always
     * accessible from the root of the object. No other metadata properties are
     * accessible.
     *
     * Only property names of the form `[a-zA-Z_.-/][a-zA-Z0-9_.-/]*` are accessible.
     * Accessible property names are escaped according to the following rules when
     * accessed in the expression: - '__' escapes to '__underscores__' - '.' escapes to
     * '__dot__' - '-' escapes to '__dash__' - '/' escapes to '__slash__' - Property
     * names that exactly match a CEL RESERVED keyword escape to '__{keyword}__'. The
     * keywords are:
     *       "true", "false", "null", "in", "as", "break", "const", "continue", "else",
     * "for", "function", "if",
     *       "import", "let", "loop", "package", "namespace", "return".
     * Examples:
     *   - Expression accessing a property named "namespace": {"Expression":
     * "object.__namespace__ > 0"}
     *   - Expression accessing a property named "x-prop": {"Expression":
     * "object.x__dash__prop > 0"}
     *   - Expression accessing a property named "redact__d": {"Expression":
     * "object.redact__underscores__d > 0"}
     *
     * Equality on arrays with list type of 'set' or 'map' ignores element order, i.e.
     * [1, 2] == [2, 1]. Concatenation on arrays with x-kubernetes-list-type use the
     * semantics of the list type:
     *   - 'set': `X + Y` performs a union where the array positions of all elements in
     * `X` are preserved and
     *     non-intersecting elements in `Y` are appended, retaining their partial
     * order.
     *   - 'map': `X + Y` performs a merge where the array positions of all keys in `X`
     * are preserved but the values
     *     are overwritten by values in `Y` when the key sets of `X` and `Y` intersect.
     * Elements in `Y` with
     *     non-intersecting keys are appended, retaining their partial order.
     * Required.
     */
    private string $expression;

    /**
     * Message represents the message displayed when validation fails. The message is
     * required if the Expression contains line breaks. The message must not contain
     * line breaks. If unset, the message is "failed rule: {Rule}". e.g. "must be a URL
     * with the host matching spec.host" If the Expression contains line breaks.
     * Message is required. The message must not contain line breaks. If unset, the
     * message is "failed Expression: {Expression}".
     */
    private string|null $message = null;

    /**
     * Reason represents a machine-readable description of why this validation failed.
     * If this is the first validation in the list to fail, this reason, as well as the
     * corresponding HTTP response code, are used in the HTTP response to the client.
     * The currently supported reasons are: "Unauthorized", "Forbidden", "Invalid",
     * "RequestEntityTooLarge". If not set, StatusReasonInvalid is used in the response
     * to the client.
     */
    private string|null $reason = null;

    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function setExpression(string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'expression' => $this->expression,
            'message' => $this->message,
            'reason' => $this->reason,
        ];
    }
}
