<?php

declare(strict_types=1);

namespace Dealroadshow\K8S;

use Dealroadshow\K8S\Data\ListMeta;
use JsonSerializable;

interface APIResourceListInterface extends JsonSerializable
{
    public function metadata(): ListMeta;
}
