<?php 

namespace Dealroadshow\K8S\ValueObject;

use JsonSerializable;

class Quantity implements JsonSerializable
{
    /**
     * @var string|float
     */
    private $value;

    /**
     * @param string|float $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function fromFloat(float $float): Quantity
    {
        return new self($float);
    }

    public static function fromString(string $string): Quantity
    {
        return new self($string);
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
