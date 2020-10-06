<?php 

namespace Dealroadshow\K8S\ValueObject;

use JsonSerializable;

class IntOrString implements JsonSerializable
{
    /**
     * @var string|int
     */
    private $value;

    /**
     * @param string|int $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function fromInt(int $int): IntOrString
    {
        return new self($int);
    }

    public static function fromString(string $string): IntOrString
    {
        return new self($string);
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
