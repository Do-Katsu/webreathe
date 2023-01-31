<?php

namespace App\Repository;

use App\Entity\Uptime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Uptime>
 *
 * @method Uptime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uptime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uptime[]    findAll()
 * @method Uptime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UptimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uptime::class);
    }

    public function save(Uptime $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Uptime $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByModuleId($moduleId)
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.modules = :id')
            ->setParameter('id', $moduleId)
            ->getQuery();

        return $qb->execute();
    }
//    /**
//     * @return Uptime[] Returns an array of Uptime objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Uptime
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
