<?php
namespace CCM\LocatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class LocatorPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $chainedLocatorDefinition = $container->findDefinition('ccm_locator.chained_locator');
        $locators = $container->findTaggedServiceIds('locator');

        foreach ($locators as $id => $locator)
        {
            $chainedLocatorDefinition->addMethodCall('addLocator', array(new Reference($id)));
        }
    }

}