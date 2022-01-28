<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * AllowedFlexVolume represents a single Flexvolume that is allowed to be used.
 */
class AllowedFlexVolume implements JsonSerializable
{
    /**
     * driver is the name of the Flexvolume driver.
     */
    private string $driver;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'driver' => $this->driver,
        ];
    }
}
