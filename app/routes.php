<?php

declare(strict_types=1);

use App\Application\Actions\Gallery\ListGalleryAction;
use App\Application\Actions\Gallery\ListGalleryAllPhotosAction;
use App\Application\Actions\Gallery\ListGalleryPhotosOnlyDoneAction;
use App\Application\Actions\ContactInfo\ListContactInfoAction;
use App\Application\Actions\ContactInfo\CreateContactInfoAction;
use App\Application\Actions\ContactInfo\DeleteContactInfoAction;
use App\Application\Actions\Gallery\ListGalleryPhotosOnlyUnderConstructionAction;
use App\Application\Actions\JobSeeker\ListJobSeekerAction;
use App\Application\Actions\Menu\CreateMenuAction;
use App\Application\Actions\Menu\DeleteMenuAction;
use App\Application\Actions\Menu\ListAdminMenuAction;
use App\Application\Actions\Menu\ListMainMenuAction;
use App\Application\Actions\Menu\ListMenuAction;
use App\Application\Actions\Menu\UpdateMenuAction;
use App\Application\Actions\Menu\ViewMenuAction;
use App\Application\Actions\Photo\ListGalleriesAction;
use App\Application\Actions\Photo\ViewGalleryAction;
use App\Application\Actions\Photo\ListPhotosAction;
use App\Application\Actions\Photo\ViewGalleryPhotosAction;
use App\Application\Actions\SiteConfig\ListSiteConfigAction;
use App\Application\Actions\SiteConfig\ViewSiteConfigAction;
use App\Application\Actions\SiteConfig\CreateSiteConfigAction;
use App\Application\Actions\SiteConfig\UpdateSiteConfigAction;
use App\Application\Actions\SiteConfig\DeleteSiteConfigAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/photo', function (Group $group) {
        $group->get('/all', ListPhotosAction::class);
    });

    $app->group('/gallery', function (Group $group) {
//        $group->get('', ListGalleriesAction::class);
//        $group->get('/{id}', ViewGalleryAction::class);
//        $group->get('/{id}/{isDone}', ViewGalleryPhotosAction::class);

        $group->get('', ListGalleryAction::class);
        $group->get('/{imageKitFolder}', ListGalleryAllPhotosAction::class);
        $group->get('/{imageKitFolder}/completed', ListGalleryPhotosOnlyDoneAction::class);
        $group->get('/{imageKitFolder}/under', ListGalleryPhotosOnlyUnderConstructionAction::class);
    });

    $app->group('/seo', function (Group $group) {
        $group->get('', ListSiteConfigAction::class);
        $group->get('/{id}', ViewSiteConfigAction::class);
        $group->post('', CreateSiteConfigAction::class);
        $group->put('', UpdateSiteConfigAction::class);
        $group->delete('/{id}', DeleteSiteConfigAction::class);
    });

    $app->group('/contact', function (Group $group) {
        $group->get('', ListContactInfoAction::class);
        $group->post('', CreateContactInfoAction::class);
        $group->delete('/{id}', DeleteContactInfoAction::class);
    });

    $app->group('/job-seeker', function (Group $group) {
        $group->get('', ListJobSeekerAction::class);
//        $group->get('/{id}', ViewSiteConfigAction::class);
//        $group->post('', CreateSiteConfigAction::class);
//        $group->put('', UpdateSiteConfigAction::class);
//        $group->delete('/{id}', DeleteSiteConfigAction::class);
    });

    $app->group('/menus', function (Group $group) {
        $group->get('', ListMenuAction::class);
        $group->get('/{id}', ViewMenuAction::class);
        $group->post('', CreateMenuAction::class);
        $group->put('', UpdateMenuAction::class);
        $group->delete('/{id}', DeleteMenuAction::class);
    });

    $app->get('/main_menu/{isShow}', ListMainMenuAction::class);
    $app->get('/admin_menu', ListAdminMenuAction::class);
};
