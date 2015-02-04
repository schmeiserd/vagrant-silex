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
                Neuer Beitrag
            </div>
            <div class="panel-body">

                <?php if ($hasError) : ?>
                    <div class="alert alert-danger" role="alert">
                        Bitte alle Felder ausfüllen!
                    </div>
                <?php endif ?>

                <form action="/form" method="post">

                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Gib einen Titel an">
                    </div>

                    <textarea class="form-control" rows="5" name="text"></textarea>
                    <br/>
                    <button type="submit" class="btn btn-primary">Absenden</button>

                </form>

            </div>
        </div>
    </div>
</div>
