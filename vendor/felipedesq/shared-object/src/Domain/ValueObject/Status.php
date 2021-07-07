<?php

namespace Whizz\SharedObject\Domain\ValueObject;

use Whizz\SharedObject\Application\Exception\ValidationException;

class Status
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_VOID = 2;

    protected $value;

    /**
     * @throws ValidationException
     */
    public static function fromInteger($value)
    {
        if (!is_int($value)) {
            throw new ValidationException('Expected integer for Status value');
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

    /**
     * @throws ValidationException
     */
    protected function validate()
    {
        $expectedValues = [
            self::STATUS_INACTIVE,
            self::STATUS_ACTIVE,
            self::STATUS_VOID,
        ];
        if (!in_array($this->value, $expectedValues)) {
            throw new ValidationException(
                sprintf('Invalid status, expected one of: %s but got %d', implode(',', $expectedValues), $this->value)
            );
        }
    }
}
