<?php
declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));
require_once APP_ROOT . '/vendor/autoload.php';

use Elephox\Docs\ContentFiles;
use Elephox\Docs\ElephoxParsedown;
use Elephox\Docs\PageRenderer;
use Elephox\Docs\Routes;
use Elephox\Docs\TemplateRenderer;
use Elephox\Web\Routing\RequestRouter;
use Elephox\Web\WebApplicationBuilder;
use Highlight\Highlighter;

$builder = WebApplicationBuilder::create();
$builder->addWhoops();
$builder->setRequestRouterEndpoint();
$builder->service(RequestRouter::class)->loadFromClass(Routes::class);
$builder->services->addSingleton(ContentFiles::class);
$builder->services->addSingleton(PageRenderer::class);
$builder->services->addSingleton(TemplateRenderer::class);
$builder->services->addSingleton(Highlighter::class);
$builder->services->addSingleton(Parsedown::class, ElephoxParsedown::class);
$app = $builder->build();
$app->run();
