<?php

namespace Whizz\SharedObject\Domain\ValueObject;

use Whizz\SharedObject\Application\Exception\ValidationException;

class EntityId
{
    protected $value;

    /**
     * @throws ValidationException
     */
    public static function fromInteger($value)
    {
        if (!is_int($value)) {
            throw new ValidationException('Expected integer for EntityId value');
        }
        $object = new static;
        $object->value = (int)$value;

        $object->validate();

        return $object;
    }

    public function toInteger(): int
    {
        return $this->value;
    }

    protected function validate(): void
    {
    }
}
