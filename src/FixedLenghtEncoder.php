<?php

namespace Aoaite\BaseEncoders;

abstract class FixedLenghtEncoder implements Encoder
{
    public function __construct(protected int $length) {}

    public function getLength(): int
    {
        return $this->length;
    }

    public abstract function getCapacity(): string;
}
