<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * Policy defines the configuration of how audit events are logged
 */
class Policy implements JsonSerializable
{
    /**
     * The Level that all requests are recorded at. available options: None, Metadata,
     * Request, RequestResponse required
     */
    private string $level;

    /**
     * Stages is a list of stages for which events are created.
     */
    private StringList $stages;

    public function __construct(string $level)
    {
        $this->level = $level;
        $this->stages = new StringList();
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function stages(): StringList
    {
        return $this->stages;
    }

    public function jsonSerialize(): array
    {
        return [
            'level' => $this->level,
            'stages' => $this->stages,
        ];
    }
}
