<?php

namespace Whizz\Gallery\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Whizz\Gallery\Entity\CategoryEntity;

class CategoryRepository extends ServiceEntityRepository
{
    private $searchFields = ['id','name'];
    private $alias = 'c';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryEntity::class);
    }

    public function save(CategoryEntity $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);
    }

    public function update(CategoryEntity $entity): void
    {
        $this->getEntityManager()->flush($entity);
    }

    public function list(): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select($this->alias)
            ->from(CategoryEntity::class, $this->alias)
        ;

        return $qb->getQuery()->getResult();
    }
}