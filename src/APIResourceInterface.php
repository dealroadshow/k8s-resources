<?php 

namespace Dealroadshow\K8S;

use Dealroadshow\K8S\Data\ObjectMeta;
use JsonSerializable;

interface APIResourceInterface extends JsonSerializable
{
    function metadata(): ObjectMeta;
}
