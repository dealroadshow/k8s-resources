<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Scheduling;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * PriorityClass defines mapping from a priority class name to the priority integer
 * value. The value can be any valid integer.
 */
class PriorityClass implements APIResourceInterface
{
    public const API_VERSION = 'scheduling.k8s.io/v1';
    public const KIND = 'PriorityClass';

    /**
     * description is an arbitrary string that usually provides guidelines on when this
     * priority class should be used.
     */
    private string|null $description = null;

    /**
     * globalDefault specifies whether this PriorityClass should be considered as the
     * default priority for pods that do not have any priority class. Only one
     * PriorityClass can be marked as `globalDefault`. However, if more than one
     * PriorityClasses exists with their `globalDefault` field set to true, the
     * smallest value of such global default PriorityClasses will be used as the
     * default priority.
     */
    private bool|null $globalDefault = null;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * PreemptionPolicy is the Policy for preempting pods with lower priority. One of
     * Never, PreemptLowerPriority. Defaults to PreemptLowerPriority if unset. This
     * field is beta-level, gated by the NonPreemptingPriority feature-gate.
     */
    private string|null $preemptionPolicy = null;

    /**
     * The value of this priority class. This is the actual priority that pods receive
     * when they have the name of this class in their pod spec.
     */
    private int $value;

    public function __construct(int $value)
    {
        $this->metadata = new ObjectMeta();
        $this->value = $value;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function getGlobalDefault(): bool|null
    {
        return $this->globalDefault;
    }

    public function getPreemptionPolicy(): string|null
    {
        return $this->preemptionPolicy;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setGlobalDefault(bool $globalDefault): self
    {
        $this->globalDefault = $globalDefault;

        return $this;
    }

    public function setPreemptionPolicy(string $preemptionPolicy): self
    {
        $this->preemptionPolicy = $preemptionPolicy;

        return $this;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'description' => $this->description,
            'globalDefault' => $this->globalDefault,
            'metadata' => $this->metadata,
            'preemptionPolicy' => $this->preemptionPolicy,
            'value' => $this->value,
        ];
    }
}
