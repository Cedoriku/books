<?php


namespace App\Controller;


use App\Entity\Book;
use App\Entity\Loan;
use App\Manager\BookManager;
use App\Manager\LoanManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BookController
 * @package App\Controller
 * @Route ("/api/books")
 */
class BookController extends AbstractFOSRestController
{

    /**
     * @Get("/", name="books")
     * @View(serializerGroups={"display"})
     * @param BookManager $bookManager
     * @param Request $request
     * @return array
     */
    public function search(BookManager $bookManager, Request $request): array
    {
        $params = $request->query;
        return $bookManager->search($params->get('name'), $params->get('page'));
    }

    /**
     * @Get("/{id}", name="book_per_id")
     * @View(serializerGroups={"display"})
     * @param BookManager $bookManager
     * @param $id
     * @return Book|null
     */
    public function find(BookManager $bookManager, $id):? Book
    {
        return $bookManager->findOneBy($id);
    }

    /**
     * @Get("/{id}/borrow", name="borrow")
     * @View(serializerGroups={"display"})
     * @param LoanManager $loanManager
     * @param $id
     * @return Book|null
     */
    public function getLoan(LoanManager $loanManager, $id):? Loan
    {
        return $loanManager->getLoan($id);
    }
}