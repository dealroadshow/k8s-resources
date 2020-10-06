<?php 

namespace Dealroadshow\K8S;

use Dealroadshow\K8S\Data\ListMeta;
use JsonSerializable;

interface APIResourceListInterface extends JsonSerializable
{
    function metadata(): ListMeta;
}
