<?php
/**
 * @var $view \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine
 * @var $slots Symfony\Component\Templating\Helper\SlotsHelper;
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
                <li <?= $page == 'parameter' ? 'class="active"' : '' ?>>
                    <a href="/blog">
                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span> Parameter
                    </a>
                </li>
                <li <?= $page == 'form' ? 'class="active"' : '' ?>>
                    <a href="/form">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Form Handling
                    </a>
                </li>
                <li>
                    <a href="/ajax">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Ajax
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php $view['slots']->output('_content') ?>
</div>
</body>
</html>