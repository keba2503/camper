<?php

namespace App\Repository;

use App\Entity\Fases;
use App\Entity\Capitulos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Capitulos>
 *
 * @method Capitulos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capitulos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capitulos[]    findAll()
 * @method Capitulos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapitulosRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 2;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Capitulos::class);
    }

    public function add(Capitulos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Capitulos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getCapitulosPaginator(Fases $fases, int $offset): Paginator
        {
            $query = $this->createQueryBuilder('c')
                ->andWhere('c.fases = :fases')
                ->setParameter('fases', $fases)
                
                ->setMaxResults(self::PAGINATOR_PER_PAGE)
                ->setFirstResult($offset)
                ->getQuery()
            ;
    
            return new Paginator($query);
        }
    //    /**
    //     * @return Capitulos[] Returns an array of Capitulos objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Capitulos
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
