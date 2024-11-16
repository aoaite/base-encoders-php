<?php

namespace Aoaite\BaseEncoders;

interface Encoder
{
    public function encodeInt(string|int $input): string;

    public function decodeInt(string $input): string;

    public function getBase(): int;
}
