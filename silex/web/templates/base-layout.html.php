<?php
/**
 * @var $view \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine
 * @var $slots Symfony\Component\Templating\Helper\SlotsHelper;
 * @var $page
 */
$slots = $view['slots'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title><?php $slots->output('title', 'My website title') ?></title>
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css"/>
    <script src="/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <base href="http://localhost:8001"/>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li <?= $page == 'static' ? 'class="active"' : '' ?>>
                    <a href="/static">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Static
                    </a>
                </li>
                <li <?= $page == 'blog' ? 'class="active"' : '' ?>>
                    <a href="/blog">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Blog
                    </a>
                </li>
                <li <?= $page == 'form' ? 'class="active"' : '' ?>>
                    <a href="/form">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> New Blog Post
                    </a>
                </li>
                <li <?= $page == 'login' ? 'class="active"' : '' ?>>
                    <a href="/login">
                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Anmelden
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php $slots->output('_content') ?>
</div>
</body>
</html>