<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/09/17
 * Time: 18:25
 */

namespace Miky\Bundle\CoreBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ShortcodePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('miky.registry.shortcode')) {
            return;
        }

        $schemaRegistry = $container->getDefinition('miky.registry.shortcode');
        $taggedServicesIds = $container->findTaggedServiceIds('miky_shortcode');

        foreach ($taggedServicesIds as $id => $tags) {
            foreach ($tags as $attributes) {
                if (!isset($attributes['alias'])) {
                    throw new \InvalidArgumentException(sprintf('Service "%s" must define the "alias" attribute on "miky_shortcode" tags.', $id));
                }
                $schemaRegistry->addMethodCall('register', [$attributes['alias'], new Reference($id)]);
            }
        }
    }
}