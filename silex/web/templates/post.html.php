<?php $view->extend('base-layout.html.php') ?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= $post['title'] ?>
                </div>
                vom
                <em>
                    <?= $post['created_at'] ?>
                </em>
            </div>
            <div class="panel-body">
                <?= $post['text'] ?>
            </div>
            <div class="panel-footer">
                <a href="/blog">
                    zurück
                </a>
            </div>
        </div>
    </div>
</div>
