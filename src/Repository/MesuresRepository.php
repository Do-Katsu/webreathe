<?php

namespace App\Repository;

use App\Entity\Mesures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mesures>
 *
 * @method Mesures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mesures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mesures[]    findAll()
 * @method Mesures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesuresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mesures::class);
    }

    public function save(Mesures $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mesures $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByTypeAndModule($type, $moduleId)
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.type = :type')
            ->andWhere('e.modules = :id')
            ->setParameter('id', $moduleId)
            ->setParameter('type', $type)
            ->getQuery();

        return $qb->execute();
    }

//    /**
//     * @return Mesures[] Returns an array of Mesures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mesures
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
