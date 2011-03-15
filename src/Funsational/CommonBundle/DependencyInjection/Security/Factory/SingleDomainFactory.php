<?php

namespace Funsational\CommonBundle\DependencyInjection\Security\Factory;

use Symfony\Component\Config\Definition\Builder;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This factory will allow firewalls to use single_domain authentication.
 * 
 * @author Michael Williams <michael.williams@funsational.com>
 */
class SingleDomainFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
    	$provider = 'funsational_common.authentication.provider.cross_domain.'.$id;
        $container
            ->setDefinition($provider, new DefinitionDecorator('funsational_common.authentication.provider.cross_domain'))
            ->addArgument($id)
        ;
        
        // listener
        $listenerId = 'funsational_common.security.authentication.listener.single_domain.'.$id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('funsational_common.security.authentication.listener.single_domain'));
        $listener->setArgument(2, $id);

        return array($provider, $listenerId, $defaultEntryPoint);
    }
    
    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'single-domain';
    }

    public function addConfiguration(NodeBuilder $builder)
    {
    	$builder
    	   ->scalarNode('sync_interval')->defaultValue(120)->end()
    	   ->scalarNode('default_domain')->cannotBeEmpty()->end()
    	;
    }
}
