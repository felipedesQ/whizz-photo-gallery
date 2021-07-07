<?php

namespace Whizz\SharedObject\Domain\ValueObject;

use Whizz\SharedObject\Application\Exception\ValidationException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class EntityUuid
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @throws \Exception
     */
    public static function generate()
    {
        $uuid = new static;
        $uuid->uuid = Uuid::uuid4();

        return $uuid;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return (string)$this->uuid;
    }

    /**
     * @throws ValidationException
     */
    public static function fromString($value)
    {
        if (!is_string($value)) {
            throw new ValidationException('Expected string for uuid value');
        }
        $uuid = new static;
        $uuid->uuid = Uuid::fromString($value);

        return $uuid;
    }

}