<?php

namespace Shared\Bundles\Book\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Configuration;
use Doctrine\DBAL\Types\StringType;
use Ramsey\Uuid\Doctrine\UuidType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class BookExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
        $doctrineConfig = $this->processConfiguration(
            new Configuration($container->getParameter('kernel.debug')),
            $container->getExtensionConfig('doctrine')
        );

        $doctrineConfig['dbal']['types']['enum'] = [
            'class' => StringType::class
        ];

        $doctrineConfig['dbal']['types'][UuidType::NAME] = [
            'class' => UuidType::class
        ];

        $doctrineConfig['orm']['entity_managers']['default']['mappings']['Book'] = [
            'type' => 'xml',
            'dir' => dirname(__DIR__, 2) . '/Resources/doctrine',
            'prefix' => 'Shared\Bundles\Book\Entity',
            'alias' => 'Book'
        ];

        $container->prependExtensionConfig('doctrine', $doctrineConfig);

        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['DoctrineMigrationsBundle'])) {
            $container->prependExtensionConfig('doctrine_migrations', [
                'migrations_paths' => [
                    'Shared\Bundles\Book\Migrations' => dirname(__DIR__, 2) . '/src/Migrations'
                ]
            ]);
        }
    }

    public function load(array $configs, ContainerBuilder $container) {}
}