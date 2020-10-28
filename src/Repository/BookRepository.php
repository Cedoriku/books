<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public const ITEMS_PER_PAGE = 20;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @param $name
     * @param $page
     * @return array
     */
    public function search($name, $page): array
    {
        $qb = $this->createQueryBuilder('b')
            ->orderBy('b.id', 'ASC')
            ->where('b.stock > 0')
            ->setFirstResult(self::ITEMS_PER_PAGE * ($page - 1))
            ->setMaxResults(self::ITEMS_PER_PAGE);

        if ($name !== '' && !is_null($name)) {
            $qb->andWhere('b.name = :name')
                ->setParameter('name', $name);
        }

        return $qb->getQuery()->getResult();
    }

}
