<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @extends ServiceEntityRepository<Livre>
 *
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }
    /*public function showlivres(?string $genres) {
        $query = $this->createQueryBuilder('l');
        if ($genres) {
            $query->leftJoin('l.genre', 'g')
            //->where('l.genre.id = :6')
            ->groupBy('l.genre','DESC')
            ->setParameter('val', $genres);
            return $query->getQuery()->getResult();
        }
    }*/
    /**
     * @return Livre[] Returns an array of Livre objects
     */
    /*public function findAllLivresJeunesse(?string $genre = null){
            $query = $this->createQueryBuilder('l');
            {
            $query->leftJoin('l.genre', 'g')
                ->Where('g.id = :genre')
                //->andWhere('g.id = 6')
                ->setParameter(':genre', $genre);
            }
            return $query->getQuery()->getResult();
        }*/
        public function FindLivresJeunesse(): array 
        {
            return $this->createQueryBuilder("l")
            ->where('l.genre = :genre')
            ->setParameter('genre', '6')
            ->getQuery()
            ->getResult();
        }

        public function findLivresContes(): array 
        {
            return $this->createQueryBuilder("l")
            ->where('l.genre = :genre')
            ->setParameter('genre', '2')
            ->getQuery()
            ->getResult();
        }
//    public function findOneBySomeField($value): ?Livre
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
