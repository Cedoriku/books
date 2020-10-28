<?php


namespace App\Manager;


use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class BookManager extends BaseManager
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Book::class);
    }

    /**
     * @param $name
     * @param $page
     * @return mixed
     */
    public function search($name, $page): array
    {
        return $this->repository->search($name, $page);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLoan($id): array
    {
        return $this->repository->getLoan($id);
    }
}