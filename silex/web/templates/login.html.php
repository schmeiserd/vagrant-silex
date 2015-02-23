<?php
/**
 * @var \Symfony\Component\Templating\PhpEngine $view
 */
?>

<?php $view->extend('base-layout.html.php') ?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Anmelden
            </div>
            <div class="panel-body">

                <form action="/login" method="post">

                    <input type="text" class="form-control" id="title" name="name" placeholder="Gib deinen Namen an">
                    <br/>
                    <button type="submit" class="btn btn-primary">Anmelden</button>

                </form>

            </div>
        </div>
    </div>
</div>
