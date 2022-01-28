<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EventSeries contain information on series of events, i.e. thing that was/is
 * happening continuously for some time.
 */
class EventSeries implements JsonSerializable
{
    /**
     * Number of occurrences in this series up to the last heartbeat time
     */
    private int|null $count = null;

    /**
     * Time of the last occurrence observed
     */
    private DateTimeInterface|null $lastObservedTime = null;

    public function __construct()
    {
    }

    public function getCount(): int|null
    {
        return $this->count;
    }

    public function getLastObservedTime(): DateTimeInterface|null
    {
        return $this->lastObservedTime;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function setLastObservedTime(DateTimeInterface $lastObservedTime): self
    {
        $this->lastObservedTime = $lastObservedTime;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'count' => $this->count,
            'lastObservedTime' => $this->lastObservedTime,
        ];
    }
}
