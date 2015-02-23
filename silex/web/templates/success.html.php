<?php
/**
 * @var \Symfony\Component\Templating\PhpEngine $view
 * @var $msg
 */

?>

<?php $view->extend('base-layout.html.php') ?>

<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                Aktion erfolgreich
            </div>
            <div class="panel-body">
                <?= $msg ?>
            </div>
        </div>
    </div>
</div>
