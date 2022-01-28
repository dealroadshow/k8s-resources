<?php

declare(strict_types=1);

namespace Dealroadshow\K8S;

use Dealroadshow\K8S\Data\ObjectMeta;
use JsonSerializable;

interface APIResourceInterface extends JsonSerializable
{
    public function metadata(): ObjectMeta;
}
