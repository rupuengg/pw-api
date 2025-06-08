<?php

declare(strict_types=1);

use App\Application\Actions\BasicConfig\CreateBasicConfigAction;
use App\Application\Actions\BasicConfig\DeleteBasicConfigAction;
use App\Application\Actions\BasicConfig\ListBasicConfigAction;
use App\Application\Actions\BasicConfig\UpdateBasicConfigAction;
use App\Application\Actions\BasicConfig\ViewBasicConfigAction;
use App\Application\Actions\BasicConfig\ViewByKeyBasicConfigAction;
use App\Application\Actions\Blog\CreateBlogAction;
use App\Application\Actions\Blog\DeleteBlogAction;
use App\Application\Actions\Blog\ListBlogAction;
use App\Application\Actions\Blog\UpdateBlogAction;
use App\Application\Actions\Blog\ViewBlogAction;
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
use App\Application\Actions\MenuGroup\CreateMenuGroupAction;
use App\Application\Actions\MenuGroup\DeleteMenuGroupAction;
use App\Application\Actions\MenuGroup\ListMenuGroupAction;
use App\Application\Actions\MenuGroup\UpdateMenuGroupAction;
use App\Application\Actions\MenuGroup\ViewMenuGroupAction;
use App\Application\Actions\MenuGroup\ViewMenuGroupByTypeAction;
use App\Application\Actions\SiteConfig\ListSiteConfigAction;
use App\Application\Actions\SiteConfig\ViewSiteConfigAction;
use App\Application\Actions\SiteConfig\CreateSiteConfigAction;
use App\Application\Actions\SiteConfig\UpdateSiteConfigAction;
use App\Application\Actions\SiteConfig\DeleteSiteConfigAction;
use App\Application\Actions\Project\ListProjectAction;
use App\Application\Actions\Project\ViewProjectAction;
use App\Application\Actions\Project\CreateProjectAction;
use App\Application\Actions\Project\UpdateProjectAction;
use App\Application\Actions\Project\DeleteProjectAction;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\DeleteUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\LoginUserAction;
use App\Application\Actions\User\LogoutUserAction;
use App\Application\Actions\User\ProfileUserAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Middleware\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

//    $app->group('/photo', function (Group $group) {
//        $group->get('/all', ListPhotosAction::class);
//    });

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
    })->add(AuthMiddleware::class);

    $app->group('/blog', function (Group $group) {
        $group->get('', ListBlogAction::class);
        $group->get('/{id}', ViewBlogAction::class);
        $group->post('', CreateBlogAction::class);
        $group->put('', UpdateBlogAction::class);
        $group->delete('/{id}', DeleteBlogAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/contact', function (Group $group) {
        $group->get('', ListContactInfoAction::class);
        $group->post('', CreateContactInfoAction::class);
        $group->delete('/{id}', DeleteContactInfoAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/job-seeker', function (Group $group) {
        $group->get('', ListJobSeekerAction::class);
//        $group->get('/{id}', ViewSiteConfigAction::class);
//        $group->post('', CreateSiteConfigAction::class);
//        $group->put('', UpdateSiteConfigAction::class);
//        $group->delete('/{id}', DeleteSiteConfigAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/menus', function (Group $group) {
        $group->get('', ListMenuAction::class);
        $group->get('/{id}', ViewMenuAction::class);
        $group->post('', CreateMenuAction::class);
        $group->put('', UpdateMenuAction::class);
        $group->delete('/{id}', DeleteMenuAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/menugroups', function (Group $group) {
        $group->get('', ListMenuGroupAction::class);
        $group->get('/{id}', ViewMenuGroupAction::class);
        $group->post('', CreateMenuGroupAction::class);
        $group->put('', UpdateMenuGroupAction::class);
        $group->delete('/{id}', DeleteMenuGroupAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('', CreateUserAction::class);
        $group->put('', UpdateUserAction::class);
        $group->delete('/{id}', DeleteUserAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/basic_config', function (Group $group) {
        $group->get('', ListBasicConfigAction::class);
        $group->get('/{id}', ViewBasicConfigAction::class);
        $group->post('', CreateBasicConfigAction::class);
        $group->put('', UpdateBasicConfigAction::class);
        $group->delete('/{id}', DeleteBasicConfigAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/project', function (Group $group) {
        $group->get('', ListProjectAction::class);
        $group->get('/{id}', ViewProjectAction::class);
        $group->post('', CreateProjectAction::class);
        $group->put('', UpdateProjectAction::class);
        $group->delete('/{id}', DeleteProjectAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/auth', function (Group $group) {
        $group->post('/login', LoginUserAction::class);
        $group->get('/profile', ProfileUserAction::class)->add(AuthMiddleware::class);
        $group->delete('/logout', LogoutUserAction::class)->add(AuthMiddleware::class);
    });

    $app->get('/menugroups/by/{type}', ViewMenuGroupByTypeAction::class);
    $app->get('/main_menu/{isShow}', ListMainMenuAction::class);
    $app->get('/admin_menu', ListAdminMenuAction::class);
    $app->get('/blog_list', ListBlogAction::class);
    $app->get('/blog_list/:id', ViewBlogAction::class);
    $app->get('/basic_config/by/{key}', ViewByKeyBasicConfigAction::class);
    $app->post('/query', CreateContactInfoAction::class);
};
