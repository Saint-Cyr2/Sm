<?php

namespace App\Repository;

use App\Entity\ItemTypeQuantity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemTypeQuantity>
 *
 * @method ItemTypeQuantity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemTypeQuantity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemTypeQuantity[]    findAll()
 * @method ItemTypeQuantity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemTypeQuantityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemTypeQuantity::class);
    }

    public function add(ItemTypeQuantity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ItemTypeQuantity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ItemTypeQuantity[] Returns an array of ItemTypeQuantity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ItemTypeQuantity
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
