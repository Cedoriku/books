<?php


namespace App\Manager;


use App\Entity\Loan;
use Doctrine\ORM\EntityManagerInterface;

class LoanManager extends BaseManager
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Loan::class);
    }

    /**
     * @param $bookId
     * @return mixed
     */
    public function getLoan($bookId): array
    {
        return $this->repository->getLoan($bookId);
    }
}