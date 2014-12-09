<?php
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\FormServiceProvider;

$app['debug'] = true;

$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new FormServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../web/templates',
    'twig.class.path' => __DIR__ . '/../vendor/twig/lib'
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname' => 'silex',
        'user' => 'silex',
        'password' => 'silex'
    ),
));

return $app;