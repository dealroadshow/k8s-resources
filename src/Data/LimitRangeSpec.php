<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\LimitRangeItemList;
use JsonSerializable;

/**
 * LimitRangeSpec defines a min/max usage limit for resources that match on kind.
 */
class LimitRangeSpec implements JsonSerializable
{
    /**
     * Limits is the list of LimitRangeItem objects that are enforced.
     */
    private LimitRangeItemList $limits;

    public function __construct()
    {
        $this->limits = new LimitRangeItemList();
    }

    public function limits(): LimitRangeItemList
    {
        return $this->limits;
    }

    public function jsonSerialize(): array
    {
        return [
            'limits' => $this->limits,
        ];
    }
}
