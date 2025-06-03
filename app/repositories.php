<?php

declare(strict_types=1);

use App\Domain\BasicConfig\BasicConfigRepository;
use App\Domain\Blog\BlogRepository;
use App\Domain\ContactInfo\ContactInfoRepository;
use App\Domain\Gallery\GalleryRepository;
use App\Domain\Menu\MenuGroupRepository;
use App\Domain\Menu\MenuRepository;
use App\Domain\Photo\PhotoRepository;
use App\Domain\Project\ProjectRepository;
use App\Domain\SiteConfig\SiteConfigRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\BasicConfig\BasicConfigReaderRepository;
use App\Infrastructure\Persistence\Blog\BlogReaderRepository;
use App\Infrastructure\Persistence\ContactInfo\ContactInfoReaderRepository;
use App\Infrastructure\Persistence\Gallery\GalleryReaderRepository;
use App\Infrastructure\Persistence\Menu\MenuGroupReaderRepository;
use App\Infrastructure\Persistence\Menu\MenuReaderRepository;
use App\Infrastructure\Persistence\Photo\PhotoReaderRepository;
use App\Infrastructure\Persistence\Project\ProjectReaderRepository;
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
        MenuGroupRepository::class => \DI\autowire(MenuGroupReaderRepository::class),
        JobSeekerRepository::class => \DI\autowire(JobSeekerReaderRepository::class),
        BlogRepository::class => \DI\autowire(BlogReaderRepository::class),
        BasicConfigRepository::class => \DI\autowire(BasicConfigReaderRepository::class),
        ProjectRepository::class => \DI\autowire(ProjectReaderRepository::class),
    ]);
};
