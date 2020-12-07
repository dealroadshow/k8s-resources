<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EventSource contains information for an event.
 */
class EventSource implements JsonSerializable
{
    /**
     * Component from which the event is generated.
     */
    private string|null $component = null;

    /**
     * Node name on which the event is generated.
     */
    private string|null $host = null;

    public function __construct()
    {
    }

    public function getComponent(): string|null
    {
        return $this->component;
    }

    public function getHost(): string|null
    {
        return $this->host;
    }

    public function setComponent(string $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'component' => $this->component,
            'host' => $this->host,
        ];
    }
}
