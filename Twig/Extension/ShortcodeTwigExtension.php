<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/09/17
 * Time: 18:38
 */

namespace Miky\Bundle\CoreBundle\Twig\Extension;




use Miky\Bundle\CoreBundle\Helper\ShortcodeHelper;

class ShortcodeTwigExtension extends \Twig_Extension
{
    /**
     * @var ShortcodeHelper
     */
    protected $helper;

    function __construct(ShortcodeHelper $helper)
    {
        $this->helper = $helper;
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('shortcodes', array($this, 'shortcodes')),
        );
    }

    public function shortcodes($content, $vars = array())
    {
        return $this->helper->doShortcodes($content, $vars);
    }

    public function getName()
    {
        return 'shortcodes';
    }
}