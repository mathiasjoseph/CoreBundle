<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/09/17
 * Time: 18:41
 */

namespace Miky\Bundle\CoreBundle\Helper;


use Miky\Component\Registry\ServiceRegistryInterface;
use Symfony\Component\Templating\Helper\HelperInterface;

class ShortcodeHelper implements HelperInterface
{

    /**
     * @var ServiceRegistryInterface
     */
    private $shortcodeRegistry;

    private 

    /**
     * ShortcodeHelper constructor.
     */
    public function __construct(ServiceRegistryInterface $shortcodeRegistry)
    {
        $this->shortcodeRegistry = $shortcodeRegistry;
    }

    private function getShortcodeNamesRegex()
    {
        $shortcode_names = array_keys($this->shortcodeRegistry->all());
        $shortcode_names_regex = join('|', array_map('preg_quote', $shortcode_names));
        return $shortcode_names_regex;
    }
    public function doShortcodes($content, $vars)
    {
        $vars = $vars;
        $shortcode_names_regex = $this->getShortcodeNamesRegex();
        $content = preg_replace_callback("/\[($shortcode_names_regex)( [^\]]*)?\](?:(.+?)?\[\/\\1\])?/",
            function ($matches) {
            $this->replaceShortcode($matches, $vars);

        }, $content);
        return $content;
    }
    public function replaceShortcode($code, $vars)
    {
        $alias = $code[1];
        $atts = (isset($code[2])) ? $code[2] : "";
        $options = array();
        foreach (explode(" ", $atts) as $att) {
            $att = trim($att);
            if (!$att) {
                continue;
            }
            list($name, $value) = explode('=', $att);
            $options[trim($name)] = trim($value);
        }
        return $this->shortcodeRegistry->get($alias)->parse($options);
    }
    /**
     * {@inheritDoc}
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }
    /**
     * {@inheritDoc}
     */
    public function getCharset()
    {
        return $this->charset;
    }
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'shortcode';
    }
}