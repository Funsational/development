<?php

namespace Funsational\CommonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\Loader\XMLFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;

class FunsationalCommonBundle extends Bundle
{	
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		
		$loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/Resources/config'));
        
		// We need to make sure that the parameter for our single domain session
		// storage is defined
		try {
			$container->getParameter('session.storage.funsational_single_domain.options');
		} catch (\InvalidArgumentException $e) {
            $container->setParameter('session.storage.funsational_single_domain.options', array());
		}
	}
	
	public function getParent()
	{
		return 'SecurityBundle';
	}
}
