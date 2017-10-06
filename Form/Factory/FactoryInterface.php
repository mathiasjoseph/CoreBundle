<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/06/17
 * Time: 23:45
 */

namespace Miky\Bundle\CoreBundle\Form\Factory;


interface FactoryInterface
{
    public function createForm($data = null, array $options = array());
}