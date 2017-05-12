<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 18/08/16
 * Time: 22:02
 */

namespace Miky\Bundle\CoreBundle\Doctrine\EventListener;


use Miky\Component\Core\Model\CommonModelInterface;
use Miky\Component\Core\Model\TimestampableTrait;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Miky\Bundle\CoreBundle\Annotation\CommonModelAnnotation;
use Miky\Component\Grid\Provider\UndefinedGridException;
use Miky\Component\Resource\Repository\Exception\ExistingResourceException;

class TimestampableSubscriber implements EventSubscriber
{
    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();
        if (!in_array(CommonModelInterface::class, class_implements($metadata->getName()))) {
            return;
        }
        $builder = new ClassMetadataBuilder($metadata);

        $reflectionClass = $metadata->getReflectionClass();
        $reader = new AnnotationReader();

        $annotation = $reader->getClassAnnotation($reflectionClass, CommonModelAnnotation::class);
        if(!$annotation) {
            return;
        }
        if(empty($annotation->timeProperties)) {
            return;
        }
        $properties = explode(", ", $annotation->timeProperties);

        foreach ($properties as $i => $property){
            if (property_exists(TimestampableTrait::class, $property)){
                $builder->addField($property, 'datetime', array(
                    'nullable' => true
                ));
            }
        }
        $builder->addLifecycleEvent("updateTimestampable", "preUpdate");
        $builder->addLifecycleEvent("persistTimestampable", "prePersist");

    }
}