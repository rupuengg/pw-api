<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'db' => [
                    'driver'	=> 'mysql',
                    'host'		=> '103.117.212.59',
                    'database' 	=> 'panachew_my_db',
                    'username' 	=> 'panachew_my_db',
                    'password' 	=> 'O#CLmKfQS*t78nqA',
                    'charset'  	=> 'utf8',
                    'collation'	=> 'utf8_unicode_ci',
                    'prefix'   	=> '',
                    'flags'   	=> [''],
                    'options' => [
                        // Turn off persistent connections
                        PDO::ATTR_PERSISTENT => false,
                        // Enable exceptions
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        // Emulate prepared statements
                        PDO::ATTR_EMULATE_PREPARES => true,
                        // Set default fetch mode to array
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        // Set character set
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
                    ],
                ],
                'imageKit' => [
                    'publicKey'		=> 'public_nCda166+V9Jj0qXrbcTIKYwYyWM=',
                    'privateKey'	=> 'private_ZEHnfXujYXhGBcfak/VAGde66CI=',
                    'urlEndpoint'	=> 'https://ik.imagekit.io/yz7i3lbbn/',
                ]
            ]);
        }
    ]);
};