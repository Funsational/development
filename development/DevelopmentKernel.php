<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class DevelopmentKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // Core system bundles
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

//            new Sonata\AdminBundle\SonataAdminBundle(),
//            new Sonata\NewsBundle\SonataNewsBundle(),
//            new Sonata\jQueryBundle\SonatajQueryBundle(),
//            new Sonata\BluePrintBundle\SonataBluePrintBundle(),

            // Common bundles
            new Funsational\CASBundle\FunsationalCASBundle(),

            // E-Commerce Bundles
            new Funsational\ECommerce\OrderBundle\FunsationalECommerceOrderBundle(),

            // Application E-Commerce bundles to tie all independent e-commerce bundles together
            new Application\Funsational\ECommerce\OrderBundle\ApplicationFunsationalECommerceOrderBundle(),

            // Demo bundles
            new Acme\DemoBundle\AcmeDemoBundle(),
        );

        if ($this->isDebug() || $this->environment == 'dev') {
        	$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Symfony\Bundle\WebConfiguratorBundle\SymfonyWebConfiguratorBundle();
        }

        return $bundles;
    }

    public function registerRootDir()
    {
        return __DIR__;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // use YAML for configuration
        $loader->load(__DIR__.'/config/config_' . $this->getEnvironment() . '.yml');
    }
}
