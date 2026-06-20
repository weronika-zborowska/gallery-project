<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Photo>
 */
class PhotoRepository extends ServiceEntityRepository
{
    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry Doctrine registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    /**
     * Returns paginated photos ordered by creation date.
     *
     * @param int $limit  Number of results.
     * @param int $offset Query offset.
     *
     * @return Photo[]
     */
    public function findLatestPaginated(int $limit, int $offset): array
    {
        return $this->createQueryBuilder('photo')
            ->orderBy('photo.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }

    /**
     * Returns total number of photos.
     *
     * @return int Number of photos.
     */
    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('photo')
            ->select('COUNT(photo.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
