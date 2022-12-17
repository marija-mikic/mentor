<?php

namespace App\Repository;

use App\Entity\FM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FM>
 *
 * @method FM|null find($id, $lockMode = null, $lockVersion = null)
 * @method FM|null findOneBy(array $criteria, array $orderBy = null)
 * @method FM[]    findAll()
 * @method FM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FM::class);
    }

    public function save(FM $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FM $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
