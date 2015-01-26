<?php
use Symfony\Component\HttpFoundation\Request;

$app->get('/static', function () use ($app) {
    return $app['templating']->render(
        'static.html.php',
        array(
            'page' => 'static'
        )
    );
});

$app->get('/parameter/{name}', function ($name) use ($app) {
    return $app['templating']->render(
        'parameter.html.php',
        array(
            'name' => $name,
            'page' => 'parameter'
        )
    );
})->value('name',  'World');

$app->get('/welcome/{name}', function ($name) use ($app) {
    return $app['templating']->render(
        'hello.html.php',
        array('name' => $name)
    );
});

$app->get('/welcome-twig/{name}', function ($name) use ($app) {
    return $app['twig']->render(
        'hello.html.twig',
        array('name' => $name)
    );
});