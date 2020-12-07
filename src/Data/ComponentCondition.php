<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Information about the condition of a component.
 */
class ComponentCondition implements JsonSerializable
{
    /**
     * Condition error code for a component. For example, a health check error code.
     */
    private string|null $error = null;

    /**
     * Message about the condition for a component. For example, information about a
     * health check.
     */
    private string|null $message = null;

    /**
     * Type of condition for a component. Valid value: "Healthy"
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getError(): string|null
    {
        return $this->error;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setError(string $error): self
    {
        $this->error = $error;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'error' => $this->error,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}
