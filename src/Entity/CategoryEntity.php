<?php

namespace Whizz\Gallery\Entity;

use Whizz\SharedObject\Entity\BaseEntity;

/**
 * @ORM\Entity(repositoryClass="Whizz\Gallery\Repository\CategoryRepository")
 * @ORM\Table(
 *     name="categories"
 * )
 */

class CategoryEntity extends BaseEntity
{

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): CategoryEntity
    {
        $this->name = $name;
        return $this;
    }

}