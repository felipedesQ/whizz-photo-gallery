<?php

namespace Whizz\Gallery\Entity\Factory;

use Whizz\Gallery\Entity\CategoryEntity;

class CategoryEntityFactory
{
    public function createFromValues
    (
        string $name
    ): CategoryEntity
    {
        $entity = New CategoryEntity();
        $entity->setName($name);

        return $entity;
    }
}