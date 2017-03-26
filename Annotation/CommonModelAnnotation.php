<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 25/03/17
 * Time: 08:07
 */

namespace Miky\Bundle\CoreBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class CommonModelAnnotation
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $timeProperties;

    /**
     * @var string
     */
    public $statusProperties;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTimeProperties()
    {
        return $this->timeProperties;
    }

    /**
     * @param string $timeProperties
     */
    public function setTimeProperties($timeProperties)
    {
        $this->timeProperties = $timeProperties;
    }

    /**
     * @return string
     */
    public function getStatusProperties()
    {
        return $this->statusProperties;
    }

    /**
     * @param string $statusProperties
     */
    public function setStatusProperties($statusProperties)
    {
        $this->statusProperties = $statusProperties;
    }




}