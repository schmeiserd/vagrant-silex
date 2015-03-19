<?php
use Symfony\Component\HttpFoundation\Request;

/** @var $app Silex\Application */

$app->get('/', function () use ($app) {
    return $app->redirect('/home');
});

$app->get('/home', function () use ($app) {
    return $app['templating']->render(
        'home.html.php',
        array(
            'page' => 'home',
            'loggedIn' => $app['session']->get('user') !== null
        )
    );
});

$app->match('/login', function (Request $request) use ($app) {
    if ($request->isMethod('POST')) {
        $name = $request->get('name');

        if ($name) {
            $app['session']->set(
                'user',
                array('username' => $name)
            );

            return $app['templating']->render(
                'success.html.php',
                array(
                    'page' => 'login',
                    'loggedIn' => $app['session']->get('user') !== null,
                    'msg' => 'Erfolgreich eingeloggt!'
                )
            );
        }
    }

    return $app['templating']->render(
        'login.html.php',
        array(
            'page' => 'login',
            'loggedIn' => $app['session']->get('user') !== null
        )
    );
});

$app->get('/logout', function (Request $request) use ($app) {
    $app['session']->clear();
    return $app->redirect('/login');
});

$app->get('blog', function () use ($app) {
    /** @var Doctrine\DBAL\Connection $dbConnection */
    $dbConnection = $app['db'];

    $posts = $dbConnection->fetchAll('SELECT * FROM blog_post');

    return $app['templating']->render(
        'list.html.php',
        array(
            'page' => 'blog',
            'loggedIn' => $app['session']->get('user') !== null,
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
            'loggedIn' => $app['session']->get('user') !== null,
            'post' => $post
        )
    );
});

$app->match('/form', function (Request $request) use ($app) {
    $hasError = false;
    $title = '';
    $text = '';

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
                    'author' => $user['username'],
                    'title' => $title,
                    'text' => $text,
                    'created_at' => $createdAt
                )
            );

            return $app['templating']->render(
                'success.html.php',
                array(
                    'page' => 'form',
                    'loggedIn' => $user !== null,
                    'msg' => 'Die Formulardaten wurden erfolgreich verarbeitet!'
                )
            );
        }
    }

    return $app['templating']->render(
        'form.html.php',
        array(
            'page' => 'form',
            'loggedIn' => $user !== null,
            'hasError' => $hasError,
            'username' => $user['username'],
            'title' => $title,
            'text' => $text
        )
    );
});
