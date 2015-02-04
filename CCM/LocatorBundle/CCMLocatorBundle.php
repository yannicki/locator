<?php

namespace CCM\LocatorBundle;

use CCM\LocatorBundle\DependencyInjection\Compiler\LocatorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CCMLocatorBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new LocatorPass());
    }

}
