<?php

namespace specifications\Whizz\SharedObject\Domain\ValueObject;

use Whizz\SharedObject\Application\Exception\ValidationException;
use Whizz\SharedObject\Domain\ValueObject\Status;
use PhpSpec\ObjectBehavior;

class StatusSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Status::class);
    }

    function it_validates()
    {
        $this->beConstructedThrough('fromInteger', [3]);
        $this->shouldThrow(ValidationException::class)->duringInstantiation();

        $this->beConstructedThrough('fromInteger', [0]);
        $this->shouldNotThrow(ValidationException::class)->duringInstantiation();

        $this->beConstructedThrough('fromInteger', [1]);
        $this->shouldNotThrow(ValidationException::class)->duringInstantiation();

        $this->beConstructedThrough('fromInteger', [2]);
        $this->shouldNotThrow(ValidationException::class)->duringInstantiation();
    }

    function it_returns_integer()
    {
        $this->beConstructedThrough('fromInteger', [1]);
        $this->toInteger()->shouldBe(1);
    }
}