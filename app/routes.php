<?php

declare(strict_types=1);

use App\Application\Actions\ContactInfo\ListContactInfoAction;
use App\Application\Actions\ContactInfo\CreateContactInfoAction;
use App\Application\Actions\Photo\ListGalleriesAction;
use App\Application\Actions\Photo\ViewGalleryAction;
use App\Application\Actions\Photo\ListPhotosAction;
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
	
	$app->group('/photos', function (Group $group) {
		$group->get('/all', ListPhotosAction::class);
	});
	
	$app->group('/galleries', function (Group $group) {
		$group->get('', ListGalleriesAction::class);
		$group->get('/{id}', ViewGalleryAction::class);
	});
	
	$app->group('/seo', function (Group $group) {
		$group->get('', ListSiteConfigAction::class);
		$group->get('/{id}', ViewSiteConfigAction::class);
		$group->post('', CreateSiteConfigAction::class);
		$group->put('', UpdateSiteConfigAction::class);
		// $group->get('/{id}', ViewGalleryAction::class);
		$group->delete('/{id}', DeleteSiteConfigAction::class);
	});

	$app->group('/contact', function(Group $group) {
		$group->get('', ListContactInfoAction::class);
		$group->post('', CreateContactInfoAction::class);
	});
};
