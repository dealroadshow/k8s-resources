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
     *
     * @var string|null
     */
    private ?string $component = null;

    /**
     * Node name on which the event is generated.
     *
     * @var string|null
     */
    private ?string $host = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getComponent(): ?string
    {
        return $this->component;
    }

    /**
     * @return string|null
     */
    public function getHost(): ?string
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

    public function jsonSerialize()
    {
        return [
            'component' => $this->component,
            'host' => $this->host,
        ];
    }
}
