<?php 

namespace Dealroadshow\K8S\ValueObject;

use DateTimeInterface;
use JsonSerializable;

class Time implements JsonSerializable
{
    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $value;

    /**
     * @param DateTimeInterface $value
     */
    private function __construct(DateTimeInterface $value)
    {
        $this->value = $value;
    }

    public static function fromDateTime(DateTimeInterface $dateTime): Time
    {
        return new self($dateTime);
    }

    public function toString(): string
    {
        return $this->value->format('c');
    }

    public function jsonSerialize()
    {
        return $this->toString();
    }
}
