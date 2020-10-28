<?php


namespace App\Manager;


use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;

class BaseManager
{
    protected $entityManager;
    /** @var ObjectRepository */
    protected $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        string $className
    )
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($className);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null): array
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function save ($entity, bool $doFlush = true)
    {
        $this->entityManager->persist($entity);

        if ($doFlush) {
            $this->entityManager->flush();
        }

        return $entity;
    }

    public function remove($entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function clear(): void
    {
        $this->entityManager->clear();
    }

    public function getReference(string $entityName, $id)
    {
        try {
            return $this->entityManager->getReference($entityName, $id);
        } catch (ORMException $e) {
        }

        return false;
    }
}