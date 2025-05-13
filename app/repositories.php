<?php

declare(strict_types=1);

use App\Domain\ContactInfo\ContactInfoRepository;
use App\Domain\Gallery\GalleryRepository;
use App\Domain\Menu\MenuRepository;
use App\Domain\Photo\PhotoRepository;
use App\Domain\SiteConfig\SiteConfigRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\ContactInfo\ContactInfoReaderRepository;
use App\Infrastructure\Persistence\Gallery\GalleryReaderRepository;
use App\Infrastructure\Persistence\Menu\MenuReaderRepository;
use App\Infrastructure\Persistence\Photo\PhotoReaderRepository;
use App\Infrastructure\Persistence\SiteConfig\SiteConfigReaderRepository;
use App\Infrastructure\Persistence\User\UserReaderRepository;
use App\Domain\JobSeeker\JobSeekerRepository;
use App\Infrastructure\Persistence\JobSeeker\JobSeekerReaderRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(UserReaderRepository::class),
        SiteConfigRepository::class => \DI\autowire(SiteConfigReaderRepository::class),
        GalleryRepository::class => \DI\autowire(GalleryReaderRepository::class),
        PhotoRepository::class => \DI\autowire(PhotoReaderRepository::class),
        ContactInfoRepository::class => \DI\autowire(ContactInfoReaderRepository::class),
        MenuRepository::class => \DI\autowire(MenuReaderRepository::class),
        JobSeekerRepository::class => \DI\autowire(JobSeekerReaderRepository::class),
    ]);
};
