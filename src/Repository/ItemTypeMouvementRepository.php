<?php

namespace App\Repository;

use App\Entity\ItemTypeMouvement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemTypeMouvement>
 *
 * @method ItemTypeMouvement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemTypeMouvement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemTypeMouvement[]    findAll()
 * @method ItemTypeMouvement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemTypeMouvementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemTypeMouvement::class);
    }

    public function add(ItemTypeMouvement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ItemTypeMouvement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ItemTypeMouvement[] Returns an array of ItemTypeMouvement objects
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

//    public function findOneBySomeField($value): ?ItemTypeMouvement
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
