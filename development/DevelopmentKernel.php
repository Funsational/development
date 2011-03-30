<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class DevelopmentKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),

            // enable third-party bundles
            new Symfony\Bundle\ZendBundle\ZendBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle(),

//            new Sonata\AdminBundle\SonataAdminBundle(),
//            new Sonata\NewsBundle\SonataNewsBundle(),
//            new Sonata\jQueryBundle\SonatajQueryBundle(),
//            new Sonata\BluePrintBundle\SonataBluePrintBundle(),

            // Common bundles
            new Funsational\CASBundle\FunsationalCASBundle(),

            new Acme\DemoBundle\AcmeDemoBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        );

        if ($this->isDebug() || $this->environment == 'dev') {
            $bundles[] = new Symfony\Bundle\WebConfiguratorBundle\SymfonyWebConfiguratorBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
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
