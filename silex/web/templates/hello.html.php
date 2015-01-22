<?php $view->extend('layout.html.php') ?>

<?php $view['slots']->set('title', "Title") ?>

Hello <?= $name; ?>!