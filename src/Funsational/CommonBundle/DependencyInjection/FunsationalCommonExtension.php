<?php

/*
 * This file is part of the Funsational Inc. Development project.
 *
 * (c) Funsational Inc <it@funsational.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Funsational\CommonBundle\DependencyInjection;

use Symfony\Component\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\XMLFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Config\Definition\Processor;

use Symfony\Component\Finder\Finder;

/**
 * FunsationalCommonExtension
 *
 * @author      Michael Williams <michael.williams@funsational.com>   
 */
class FunsationalCommonExtension extends Extension
{
    /**
     * 
     * @param array            $config    An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
    	// session.storage.funsational_single_domain.options is set in the framework
    	// configuration file and will be erased when passing the parameter in the 
    	// SingleDomainSessionStorage class. I beleive this is due to optimzation pass on
    	// the DI side of things
    	$container->setParameter('funsational_common.single_session.options', 
    	$container->getParameter('session.storage.funsational_single_domain.options'));

    	$container->setParameter('session.class', 'Funsational\CommonBundle\Session');
    	
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('security.xml');
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://www.sonata-project.org/schema/dic/admin';
    }

    public function getAlias()
    {
        return 'funsational_common';
    }
}