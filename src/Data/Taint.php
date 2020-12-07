<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * The node this Taint is attached to has the "effect" on any pod that does not
 * tolerate the Taint.
 */
class Taint implements JsonSerializable
{
    /**
     * Required. The effect of the taint on pods that do not tolerate the taint. Valid
     * effects are NoSchedule, PreferNoSchedule and NoExecute.
     */
    private string $effect;

    /**
     * Required. The taint key to be applied to a node.
     */
    private string $key;

    /**
     * TimeAdded represents the time at which the taint was added. It is only written
     * for NoExecute taints.
     */
    private DateTimeInterface|null $timeAdded = null;

    /**
     * Required. The taint value corresponding to the taint key.
     */
    private string|null $value = null;

    public function __construct(string $effect, string $key)
    {
        $this->effect = $effect;
        $this->key = $key;
    }

    public function getEffect(): string
    {
        return $this->effect;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getTimeAdded(): DateTimeInterface|null
    {
        return $this->timeAdded;
    }

    public function getValue(): string|null
    {
        return $this->value;
    }

    public function setEffect(string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setTimeAdded(DateTimeInterface $timeAdded): self
    {
        $this->timeAdded = $timeAdded;

        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'effect' => $this->effect,
            'key' => $this->key,
            'timeAdded' => $this->timeAdded,
            'value' => $this->value,
        ];
    }
}
