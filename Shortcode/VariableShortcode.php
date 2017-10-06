<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/09/17
 * Time: 18:33
 */

namespace Miky\Bundle\CoreBundle\Shortcode;


class VariableShortcode implements ShortcodeInterface
{
    public function parse($options, $vars = array()){
        if (array_key_exists("name", $options)){
            $name = $options["name"];
            if (array_key_exists($name, $vars)){
                return $vars[$name];
            }
        }
        return null;
    }
}