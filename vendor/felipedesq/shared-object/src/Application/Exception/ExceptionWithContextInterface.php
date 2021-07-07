<?php

namespace Whizz\SharedObject\Application\Exception;

interface ExceptionWithContextInterface
{
    public function getContext();
}
