<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Selective\Database\Connection;
// use ImageKit\Configuration;
use ImageKit\ImageKit;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        // Database connection
        Connection::class => function (ContainerInterface $container) {
            return new Connection($container->get(PDO::class));
        },
        PDO::class => function (ContainerInterface $container) {
            $settings = $container->get(SettingsInterface::class);
            $db = $settings->get('db');

            $driver		= $db['driver'];
            $host		= $db['host'];
            $dbname		= $db['database'];
            $username	= $db['username'];
            $password	= $db['password'];
            $charset	= $db['charset'];
            $flags		= $db['flags'];
            $dsn		= "$driver:host=$host;dbname=$dbname;charset=utf8;collation=utf8_unicode_ci";

            $pdo = new PDO($dsn, $username, $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        },
        ImageKit::class => function (ContainerInterface $container) {
            $settings = $container->get(SettingsInterface::class);
            $imageKit = $settings->get('imageKit');

            return new ImageKit($imageKit['publicKey'], $imageKit['privateKey'], $imageKit['urlEndpoint']);
        },
    ]);
};
