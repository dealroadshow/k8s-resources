<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PriorityLevelConfigurationSpec specifies the configuration of a priority level.
 */
class PriorityLevelConfigurationSpec implements JsonSerializable
{
    /**
     * `limited` specifies how requests are handled for a Limited priority level. This
     * field must be non-empty if and only if `type` is `"Limited"`.
     */
    private LimitedPriorityLevelConfiguration $limited;

    /**
     * `type` indicates whether this priority level is subject to limitation on request
     * execution.  A value of `"Exempt"` means that requests of this priority level are
     * not subject to a limit (and thus are never queued) and do not detract from the
     * capacity made available to other priority levels.  A value of `"Limited"` means
     * that (a) requests of this priority level _are_ subject to limits and (b) some of
     * the server's limited capacity is made available exclusively to this priority
     * level. Required.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->limited = new LimitedPriorityLevelConfiguration();
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function limited(): LimitedPriorityLevelConfiguration
    {
        return $this->limited;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'limited' => $this->limited,
            'type' => $this->type,
        ];
    }
}
