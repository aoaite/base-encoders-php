<?php

namespace Tests\Unit;

use Aoaite\BaseEncoders\Encoder;
use Aoaite\BaseEncoders\Encoders\Base26AlphaEncoder;
use Aoaite\BaseEncoders\Exceptions\CapacityExceededException;
use Aoaite\BaseEncoders\Exceptions\InvalidInputException;
use PHPUnit\Framework\TestCase;

class Base26AlphaTest extends TestCase
{
    protected Encoder $encoder;

    protected function setUp(): void
    {
        $this->encoder = new Base26AlphaEncoder(6);
    }

    public function test_lenght(): void
    {
        $this->assertEquals(strlen($this->encoder->encodeInt(0)), 6);
    }

    public function test_encoder(): void
    {
        $this->assertTrue($this->encoder->encodeInt(0) == 'AAAAAA');
        $this->assertTrue($this->encoder->encodeInt(1) == 'AAAAAB');
        $this->assertTrue($this->encoder->encodeInt(2) == 'AAAAAC');
        $this->assertTrue($this->encoder->encodeInt(3) == 'AAAAAD');
        $this->assertTrue($this->encoder->encodeInt(170459) == 'AAJSED');
        $this->assertTrue($this->encoder->encodeInt(170460) == 'AAJSEE');
    }

    public function test_negative_input_exception(): void
    {
        $this->expectException(InvalidInputException::class);
        $this->encoder->encodeInt(-99);
    }

    public function test_big_input_exception(): void
    {
        $this->expectException(CapacityExceededException::class);
        $this->encoder->encodeInt("750913540641059743650197535239");
    }
}
