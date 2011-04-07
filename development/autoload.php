<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Acme'                           => __DIR__.'/../src',
    'Application'                    => __DIR__.'/../src',
    'Bundle'                   		 => __DIR__.'/../src',
    'Funsational'                    => __DIR__.'/../src',
    'FOS'                            => __DIR__.'/../src',
    'Knplabs'                        => __DIR__.'/../src',
    'Sonata'                         => __DIR__.'/../src',

    'Doctrine'                       => __DIR__.'/../vendor/doctrine/lib',
    'Doctrine\\Common'               => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor/doctrine-data-fixtures/lib',
    'Doctrine\\DBAL'                 => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine\\DBAL\\Migrations'     => __DIR__.'/../vendor/doctrine-migrations/lib',
    'Doctrine\\MongoDB'              => __DIR__.'/../vendor/doctrine-mongodb/lib',
    'Doctrine\\ODM\\MongoDB'         => __DIR__.'/../vendor/doctrine-mongodb-odm/lib',

    'JMS'                            => __DIR__.'/../vendor/bundles',
    'Sensio'                         => __DIR__.'/../vendor/bundles',

    'Assetic'                        => __DIR__.'/../vendor/assetic/src',
    'Symfony'                        => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Monolog'                        => __DIR__.'/../vendor/monolog/src',


));

$loader->registerPrefixes(array(
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Swift_'           => __DIR__.'/../vendor/swiftmailer/lib/classes',
));
$loader->register();
