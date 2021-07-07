<?php

namespace Whizz\SharedObject\Application\Exception;

class EntityNotFoundException extends Exception
{
    /**
     * Override parent function for the sole purpose of enforcing the return type so the IDE doesn't get mixed up.
     *
     * @param string $message
     * @param null $context
     * @param int $code
     * @param \Throwable|null $previous
     * @return EntityNotFoundException
     */
    public static function create(string $message, $context = null, int $code = 0, \Throwable $previous = null): EntityNotFoundException
    {
        return parent::create($message, $context, $code, $previous);
    }
}
