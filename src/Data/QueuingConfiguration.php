<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * QueuingConfiguration holds the configuration parameters for queuing
 */
class QueuingConfiguration implements JsonSerializable
{
    /**
     * `handSize` is a small positive number that configures the shuffle sharding of
     * requests into queues.  When enqueuing a request at this priority level the
     * request's flow identifier (a string pair) is hashed and the hash value is used
     * to shuffle the list of queues and deal a hand of the size specified here.  The
     * request is put into one of the shortest queues in that hand. `handSize` must be
     * no larger than `queues`, and should be significantly smaller (so that a few
     * heavy flows do not saturate most of the queues).  See the user-facing
     * documentation for more extensive guidance on setting this field.  This field has
     * a default value of 8.
     */
    private int|null $handSize = null;

    /**
     * `queueLengthLimit` is the maximum number of requests allowed to be waiting in a
     * given queue of this priority level at a time; excess requests are rejected.
     * This value must be positive.  If not specified, it will be defaulted to 50.
     */
    private int|null $queueLengthLimit = null;

    /**
     * `queues` is the number of queues for this priority level. The queues exist
     * independently at each apiserver. The value must be positive.  Setting it to 1
     * effectively precludes shufflesharding and thus makes the distinguisher method of
     * associated flow schemas irrelevant.  This field has a default value of 64.
     */
    private int|null $queues = null;

    public function __construct()
    {
    }

    public function getHandSize(): int|null
    {
        return $this->handSize;
    }

    public function getQueueLengthLimit(): int|null
    {
        return $this->queueLengthLimit;
    }

    public function getQueues(): int|null
    {
        return $this->queues;
    }

    public function setHandSize(int $handSize): self
    {
        $this->handSize = $handSize;

        return $this;
    }

    public function setQueueLengthLimit(int $queueLengthLimit): self
    {
        $this->queueLengthLimit = $queueLengthLimit;

        return $this;
    }

    public function setQueues(int $queues): self
    {
        $this->queues = $queues;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'handSize' => $this->handSize,
            'queueLengthLimit' => $this->queueLengthLimit,
            'queues' => $this->queues,
        ];
    }
}
