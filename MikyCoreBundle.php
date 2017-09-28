<?php

namespace Miky\Bundle\CoreBundle;

use Miky\Bundle\CoreBundle\DependencyInjection\Compiler\ShortcodePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MikyCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ShortcodePass());
    }

}
