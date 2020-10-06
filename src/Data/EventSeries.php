<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\MicroTime;
use JsonSerializable;

/**
 * EventSeries contain information on series of events, i.e. thing that was/is
 * happening continuously for some time.
 */
class EventSeries implements JsonSerializable
{
    /**
     * Number of occurrences in this series up to the last heartbeat time
     *
     * @var int|null
     */
    private ?int $count = null;

    /**
     * Time of the last occurrence observed
     *
     * @var MicroTime|null
     */
    private ?MicroTime $lastObservedTime = null;

    /**
     * State of this Series: Ongoing or Finished Deprecated. Planned removal for 1.18
     *
     * @var string|null
     */
    private ?string $state = null;

    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @return MicroTime|null
     */
    public function getLastObservedTime(): ?MicroTime
    {
        return $this->lastObservedTime;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function setLastObservedTime(MicroTime $lastObservedTime): self
    {
        $this->lastObservedTime = $lastObservedTime;

        return $this;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'count' => $this->count,
            'lastObservedTime' => $this->lastObservedTime,
            'state' => $this->state,
        ];
    }
}
