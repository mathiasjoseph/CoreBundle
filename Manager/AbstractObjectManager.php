<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 27/10/16
 * Time: 15:07
 */

namespace Miky\Bundle\CoreBundle\Manager;


use Doctrine\Common\Persistence\ObjectManager;

class AbstractObjectManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

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
     * @param ObjectManager $om
     * @param string $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);
        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    public function supportsClass($class)
    {
        return $class === $this->getClass();
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function setObjectManager($objectManager)
    {
        $this->objectManager = $objectManager;
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
        $this->objectManager->remove($entity);
        $this->objectManager->flush();
    }

    protected function updateEntity($entity, $andFlush = true)
    {
        $this->objectManager->persist($entity);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    protected function createEntity()
    {
        $class = $this->getClass();
        $entity = new $class;
        return $entity;
    }
}