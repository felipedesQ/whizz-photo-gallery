<?php

namespace Whizz\Gallery\Service;

use Whizz\Gallery\Entity\Factory\CategoryEntityFactory;
use Whizz\Gallery\Repository\CategoryRepository;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var CategoryEntityFactory
     */
    private $categoryEntityFactory;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryEntityFactory $categoryEntityFactory
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryEntityFactory = $categoryEntityFactory;
    }

    public function createCategory($payload)
    {
        $entity = $this->categoryEntityFactory->createFromValues(
            $payload->name
        );

        $this->categoryRepository->save($entity);
    }

}