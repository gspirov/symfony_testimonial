<?php

namespace Shared\Bundles\Book\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Configuration;
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

        $doctrineConfig['dbal']['types'][UuidType::NAME] = [
            'class' => UuidType::class
        ];

        $doctrineConfig['orm']['entity_managers']['default']['mappings']['transaction'] = [
            'type' => 'xml',
            'dir' => '%kernel.project_dir%/vendor/condor-bundles/transaction/Resources/doctrine',
            'prefix' => 'Condor\Bundles\Transaction\Entity',
            'alias' => 'Transaction',
        ];

        $container->prependExtensionConfig('doctrine', $doctrineConfig);

        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['DoctrineMigrationsBundle'])) {
            $container->prependExtensionConfig('doctrine_migrations', [
                'migrations_paths' => [
                    'DoctrineMigrations' => dirname(__DIR__, 2) . '/migrations'
                ]
            ]);
        }
    }

    public function load(array $configs, ContainerBuilder $container) {}
}