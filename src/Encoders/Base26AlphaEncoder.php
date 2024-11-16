<?php

namespace Aoaite\BaseEncoders\Encoders;

use Aoaite\BaseEncoders\Exceptions\CapacityExceededException;
use Aoaite\BaseEncoders\Exceptions\InvalidInputException;
use Aoaite\BaseEncoders\FixedLenghtEncoder;

class Base26AlphaEncoder extends FixedLenghtEncoder
{
    private const base = 26;

    public function encodeInt(string|int $input): string
    {
        if (bccomp($input, '0') == -1) {
            throw new InvalidInputException('Input is negative');
        }

        if (bccomp($this->getCapacity(), $input) == -1) {
            throw new CapacityExceededException('Input is too big');
        }

        $result = '';
        $remainder = '0';
        while ($input > 0) {
            $remainder = bcmod($input, self::base);
            $result .= chr(65 + intval($remainder));
            $input = bcdiv($input, self::base);
        }

        $result = strrev($result);

        while (strlen($result) < $this->length) {
            $result = 'A' . $result;
        }

        return $result;
    }

    public function decodeInt(string $input): string
    {
        $result = '0';
        for ($i = 0; $i < $this->length; $i++) {
            $result = bcmul($result, self::base);
            $result = bcadd($result, ord($input[$i]) - 65);
        }
        return $result;
    }

    public function getBase(): int
    {
        return self::base;
    }

    public function getCapacity(): string
    {
        return bcpow(self::base, $this->getLength());
    }
}
