<?php
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\CsrfServiceProvider;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\DelegatingEngine;
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Bridge\Twig\TwigEngine;

$app['debug'] = true;

$app->register(new TranslationServiceProvider());
$app->register(new LocaleServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new CsrfServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../web/templates',
    'twig.class.path' => __DIR__ . '/../vendor/twig/lib'
));

$app['templating.engines'] = function () {
    return array(
        'twig',
        'php'
    );
};

$app['templating.loader'] = function () {
    return new FilesystemLoader(__DIR__ . '/../web/templates/%name%');
};

$app['templating.template_name_parser'] = function() {
    return new TemplateNameParser();
};

$app['templating.engine.php'] = function() use ($app) {
    $engine = new PhpEngine(
        $app['templating.template_name_parser'],
        $app['templating.loader']
    );
    $engine->set(new SlotsHelper());
    return $engine;
};

$app['templating.engine.twig'] = function() use ($app) {
    return new TwigEngine($app['twig'], $app['templating.template_name_parser']);
};

$app['templating'] = function() use ($app) {
    $engines = array();
    foreach ($app['templating.engines'] as $i => $engine) {
        if (is_string($engine)) {
            $engines[$i] = $app[sprintf('templating.engine.%s', $engine)];
        }
    }
    return new DelegatingEngine($engines);
};

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname' => 'silex',
        'user' => 'silex',
        'password' => 'silex'
    ),
));

return $app;