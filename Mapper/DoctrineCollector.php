<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 06/04/17
 * Time: 16:25
 */

namespace Miky\Bundle\CoreBundle\Mapper;


class DoctrineCollector
{
    protected $associations;
    protected $indexes;
    private static $instance;
    public function __construct()
    {
        $this->associations = array();
        $this->indexes = array();
    }
    /**
     * @return DoctrineCollector
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    /**
     * @param $class
     * @param $type
     * @param  array $options
     * @return void
     */
    public function addAssociation($class, $type, array $options)
    {
        if (!isset($this->associations[$class])) {
            $this->associations[$class] = array();
        }
        if (!isset($this->associations[$class][$type])) {
            $this->associations[$class][$type] = array();
        }
        $this->associations[$class][$type][] = $options;
    }
    /**
     * @param $class
     * @param $name
     * @param  array $columns
     * @return void
     */
    public function addIndex($class, $name, array $columns)
    {
        if (!isset($this->indexes[$class])) {
            $this->indexes[$class] = array();
        }
        if (isset($this->indexes[$class][$name])) {
            return;
        }
        $this->indexes[$class][$name] = $columns;
    }
    /**
     * @return array
     */
    public function getAssociations()
    {
        return $this->associations;
    }
    /**
     * @return array
     */
    public function getIndexes()
    {
        return $this->indexes;
    }
}