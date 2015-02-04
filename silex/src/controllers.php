<?php
use Symfony\Component\HttpFoundation\Request;

/** @var $app Silex\Application */

$app->get('/route', function (Request $request) use ($app) {
    $returnVal = "";

    $returnVal .= $request->isMethod('GET') ? 'true' : 'false';
    $returnVal .= ' - ';
    $returnVal .= $request->get('answer');
    $returnVal .= ' - ';
    $returnVal .= $request->get('foo');
    $returnVal .= ' - ';
    $returnVal .= $request->get('foo', 'bar');

    return $returnVal;
});

$app->get('/static', function () use ($app) {
    return $app['templating']->render(
        'static.html.php',
        array(
            'page' => 'static'
        )
    );
});

$app->get('/blog/{id}', function ($id) use ($app) {
    /** @var Doctrine\DBAL\Connection $dbConnection */
    $dbConnection = $app['db'];

    if (!$id) {
        $posts = $dbConnection->fetchAll('SELECT * FROM blog_post');

        return $app['templating']->render(
            'list.html.php',
            array(
                'page' => 'parameter',
                'posts' => $posts
            )
        );
    } else {
        $post = $dbConnection->fetchAssoc(
            'SELECT * FROM blog_post WHERE id = ?',
            array($id)
        );
        return $app['templating']->render(
            'post.html.php',
            array(
                'page' => 'blog',
                'post' => $post
            )
        );
    }
})->value('id', false);

$app->match('/form', function (Request $request) use ($app) {
    $hasError = false;

    if ($request->isMethod('POST')) {
        $title = $request->get('title');
        $text = $request->get('text');
        $createdAt = date('c');

        $hasError = (empty($title) || empty($text));
        if (!$hasError) {
            /** @var Doctrine\DBAL\Connection $db */
            $db = $app['db'];
            $db->insert(
                'blog_post',
                array(
                    'title' => $title,
                    'text' => $text,
                    'created_at' => $createdAt
                )
            );

            return $app['templating']->render(
                'form-success.html.php',
                array(
                    'page' => 'form'
                )
            );
        }
    }

    return $app['templating']->render(
        'form.html.php',
        array(
            'page' => 'form',
            'hasError' => $hasError
        )
    );
});

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