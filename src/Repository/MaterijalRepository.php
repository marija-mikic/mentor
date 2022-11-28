<?php

namespace App\Repository;

use App\Entity\Materijal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Materijal>
 *
 * @method Materijal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materijal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materijal[]    findAll()
 * @method Materijal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterijalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materijal::class);
    }

    public function save(Materijal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Materijal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
