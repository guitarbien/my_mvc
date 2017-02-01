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
$injector->alias(App\Template\Renderer::class, App\Template\MustacheRenderer::class);
$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
            'extension' => '.html',
        ]),
    ],
]);

return $injector;
