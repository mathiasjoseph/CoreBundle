<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 27/10/16
 * Time: 15:07
 */

namespace Miky\Bundle\CoreBundle\Doctrine;


use Doctrine\ORM\EntityManager;

class BaseEntityManager implements EntityManagerInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    /**
     * Constructor.
     * @param EntityManager $om
     * @param string $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->entityManager = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    public function supportsClass($class)
    {
        return $class === $this->getClass();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }



    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectRepository $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    protected function deleteEntity($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    protected function updateEntity($entity, $andFlush = true)
    {
        $this->entityManager->persist($entity);
        if ($andFlush) {
            $this->entityManager->flush();
        }
    }


    public function createEntity()
    {
        $class = $this->getClass();
        $entity = new $class;
        return $entity;
    }
}