<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EnvVar represents an environment variable present in a Container.
 */
class EnvVar implements JsonSerializable
{
    /**
     * Name of the environment variable. Must be a C_IDENTIFIER.
     */
    private string $name;

    /**
     * Variable references $(VAR_NAME) are expanded using the previous defined
     * environment variables in the container and any service environment variables. If
     * a variable cannot be resolved, the reference in the input string will be
     * unchanged. The $(VAR_NAME) syntax can be escaped with a double $$, ie:
     * $$(VAR_NAME). Escaped references will never be expanded, regardless of whether
     * the variable exists or not. Defaults to "".
     *
     * @var string|null
     */
    private ?string $value = null;

    /**
     * Source for the environment variable's value. Cannot be used if value is not
     * empty.
     */
    private EnvVarSource $valueFrom;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->valueFrom = new EnvVarSource();
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function valueFrom(): EnvVarSource
    {
        return $this->valueFrom;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'valueFrom' => $this->valueFrom,
        ];
    }
}
