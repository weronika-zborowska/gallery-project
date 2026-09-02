<?php

/**
 * Photo repository.
 */

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository responsible for photo queries.
 *
 * @extends ServiceEntityRepository<Photo>
 */
class PhotoRepository extends ServiceEntityRepository
{
    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry doctrine registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    /**
     * Creates query for newest photos.
     *
     * @return QueryBuilder photo query builder
     */
    public function getLatestQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('photo')
            ->orderBy('photo.createdAt', 'DESC');
    }
}
