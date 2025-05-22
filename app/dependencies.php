<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Selective\Database\Connection;
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

            $driver     = $db['driver'];
            $host       = $db['host'];
            $dbname     = $db['database'];
            $username   = $db['username'];
            $password   = $db['password'];
            $charset    = $db['charset'];
            $flags      = $db['flags'];
            $dsn        = "$driver:host=$host;dbname=$dbname;charset=utf8;collation=utf8_unicode_ci";

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
        PHPMailer::class => function (ContainerInterface $container) {
            $settings = $container->get(SettingsInterface::class);
            $mailConfig = $settings->get('mailConfig');
            $mail = new PHPMailer(true);

//            try {
                // Enable/Disable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                // Configure SMTP
                $mail->isSMTP();
                $mail->Host = $mailConfig['Host'];
                $mail->SMTPAuth = $mailConfig['SMTPAuth'];
                $mail->Username = $mailConfig['Username'];
                $mail->Password = $mailConfig['Password'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = $mailConfig['Port'];

                // Set sender and recipient
                $mail->setFrom($mailConfig['FromEmail'], $mailConfig['FromName']);
//                $mail->addAddress('to@example.com', 'Recipient Name');

                // Set email content
//                $mail->Subject = 'Email Subject';
//                $mail->Body = 'This is the email body.';

                // Send the email
//                $mail->send();
//                return $response->write('Message sent!');

                return $mail;

//            } catch (Exception $e) {
//                throw new \PHPUnit\Framework\Error($e);
////                return $response->write('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
//            }
        }
    ]);
};
