<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * LimitedPriorityLevelConfiguration specifies how to handle requests that are
 * subject to limits. It addresses two issues:
 *  * How are requests for this priority level limited?
 *  * What should be done with requests that exceed the limit?
 */
class LimitedPriorityLevelConfiguration implements JsonSerializable
{
    /**
     * `assuredConcurrencyShares` (ACS) configures the execution limit, which is a
     * limit on the number of requests of this priority level that may be exeucting at
     * a given time.  ACS must be a positive number. The server's concurrency limit
     * (SCL) is divided among the concurrency-controlled priority levels in proportion
     * to their assured concurrency shares. This produces the assured concurrency value
     * (ACV) --- the number of requests that may be executing at a time --- for each
     * such priority level:
     *
     *             ACV(l) = ceil( SCL * ACS(l) / ( sum[priority levels k] ACS(k) ) )
     *
     * bigger numbers of ACS mean more reserved concurrent requests (at the expense of
     * every other PL). This field has a default value of 30.
     */
    private int|null $assuredConcurrencyShares = null;

    /**
     * `limitResponse` indicates what to do with requests that can not be executed
     * right now
     */
    private LimitResponse|null $limitResponse = null;

    public function __construct()
    {
    }

    public function getAssuredConcurrencyShares(): int|null
    {
        return $this->assuredConcurrencyShares;
    }

    public function getLimitResponse(): LimitResponse|null
    {
        return $this->limitResponse;
    }

    public function setAssuredConcurrencyShares(int $assuredConcurrencyShares): self
    {
        $this->assuredConcurrencyShares = $assuredConcurrencyShares;

        return $this;
    }

    public function setLimitResponse(LimitResponse $limitResponse): self
    {
        $this->limitResponse = $limitResponse;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'assuredConcurrencyShares' => $this->assuredConcurrencyShares,
            'limitResponse' => $this->limitResponse,
        ];
    }
}
