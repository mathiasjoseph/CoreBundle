<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/09/17
 * Time: 18:33
 */

namespace Miky\Bundle\CoreBundle\Shortcode;


interface ShortcodeInterface
{
    public function parse($options, $vars = array());
}