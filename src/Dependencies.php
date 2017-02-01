<?php

$injector = new Auryn\Injector;

/**
 * Request
 */
$injector->alias(Http\Request::class, Http\HttpRequest::class);
$injector->share(Http\HttpRequest::class);
$injector->define(Http\HttpRequest::class, [
    ':get'     => $_GET,
    ':post'    => $_POST,
    ':cookies' => $_COOKIE,
    ':files'   => $_FILES,
    ':server'  => $_SERVER,
]);

/**
 * Response
 */
$injector->alias(Http\Response::class, Http\HttpResponse::class);
$injector->share(Http\HttpResponse::class);

/**
 * Template
 */
// Twig
$injector->alias(App\Template\Renderer::class, App\Template\TwigRenderer::class);
// $injector->define(Twig_Environment::class, [
//     ':loader' => new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates'),
// ]);
$injector->delegate(Twig_Environment::class, function () {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig   = new Twig_Environment($loader);
    return $twig;
});


// // Mustache
// $injector->alias(App\Template\Renderer::class, App\Template\MustacheRenderer::class);
// $injector->define(Mustache_Engine::class, [
//     ':options' => [
//         'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
//             'extension' => '.html',
//         ]),
//     ],
// ]);

/**
 * Page reader
 */
$injector->alias(App\Page\PageReader::class, App\Page\FilePageReader::class);
$injector->define(App\Page\FilePageReader::class, [
    ':pageFolder' => __DIR__ . '/../pages',
]);
$injector->share(App\Page\FilePageReader::class);

/**
 * FrontendRenderer
 */
$injector->alias(App\Template\FrontendRenderer::class, App\Template\FrontendTwigRenderer::class);

/**
 * Menu
 */
$injector->alias(App\Menu\MenuReader::class, App\Menu\ArrayMenuReader::class);
$injector->share(App\Menu\ArrayMenuReader::class);

return $injector;
