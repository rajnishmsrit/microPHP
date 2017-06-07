<?php declare(strict_types = 1);

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');
/*
$injector->alias('microphp\Template\Renderer', 'microphp\Template\MustacheRenderer');
$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
            'extension' => '.html',
        ]),
    ],
]);
*/

$injector->alias('microphp\Template\Renderer', 'microphp\Template\TwigRenderer');
$injector->delegate('Twig_Environment', function () use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});

$injector->alias('microphp\Template\FrontendRenderer', 'microphp\Template\FrontendTwigRenderer');

//ch 10
$injector->alias('microphp\Menu\MenuReader', 'microphp\Menu\ArrayMenuReader');
$injector->share('microphp\Menu\ArrayMenuReader');

$injector->define('microphp\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);

$injector->alias('microphp\Page\PageReader', 'microphp\Page\FilePageReader');
$injector->share('microphp\Page\FilePageReader');

return $injector;
