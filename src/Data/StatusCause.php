<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * StatusCause provides more information about an api.Status failure, including
 * cases when multiple errors are encountered.
 */
class StatusCause implements JsonSerializable
{
    /**
     * The field of the resource that has caused this error, as named by its JSON
     * serialization. May include dot and postfix notation for nested attributes.
     * Arrays are zero-indexed.  Fields may appear more than once in an array of causes
     * due to fields having multiple errors. Optional.
     *
     * Examples:
     *   "name" - the field "name" on the current resource
     *   "items[0].name" - the field "name" on the first array entry in "items"
     */
    private string|null $field = null;

    /**
     * A human-readable description of the cause of the error.  This field may be
     * presented as-is to a reader.
     */
    private string|null $message = null;

    /**
     * A machine-readable description of the cause of the error. If this value is empty
     * there is no information available.
     */
    private string|null $reason = null;

    public function __construct()
    {
    }

    public function getField(): string|null
    {
        return $this->field;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

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
            'field' => $this->field,
            'message' => $this->message,
            'reason' => $this->reason,
        ];
    }
}
