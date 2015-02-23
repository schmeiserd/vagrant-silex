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

$app->get('/db', function () use ($app) {
    /** @var Doctrine\DBAL\Connection $dbConnection */
    $dbConnection = $app['db'];

    $title = "";
    $text = "";
    $createdAt = "";

    $posts = $dbConnection->fetchAll('SELECT * FROM blog_post');


    $returnVal = var_dump($posts);
    // do stuff

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

$app->match('/login', function (Request $request) use ($app) {
    if ($request->isMethod('POST')) {
        $name = $request->get('name');

        if ($name) {

            $app['session']->set(
                'user',
                array('user' => $name)
            );

            return $app['templating']->render(
                'success.html.php',
                array(
                    'page' => 'login',
                    'msg' => 'Erfolgreich eingeloggt!'
                )
            );
        }
    }

    return $app['templating']->render(
        'login.html.php',
        array(
            'page' => 'login'
        )
    );
});

$app->get('blog', function () use ($app) {
    /** @var Doctrine\DBAL\Connection $dbConnection */
    $dbConnection = $app['db'];

    $posts = $dbConnection->fetchAll('SELECT * FROM blog_post');

    return $app['templating']->render(
        'list.html.php',
        array(
            'page' => 'blog',
            'posts' => $posts
        )
    );
});

$app->get('/blog-post/{id}', function ($id) use ($app) {
    /** @var Doctrine\DBAL\Connection $dbConnection */
    $dbConnection = $app['db'];

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
});

$app->match('/form', function (Request $request) use ($app) {
    $hasError = false;

    if (null === $user = $app['session']->get('user')) {
        return $app->redirect('/login');
    }

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
                    'author' => $user,
                    'title' => $title,
                    'text' => $text,
                    'created_at' => $createdAt
                )
            );

            return $app['templating']->render(
                'success.html.php',
                array(
                    'page' => 'form',
                    'msg' => 'Die Formulardaten wurden erfolgreich verarbeitet!'
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