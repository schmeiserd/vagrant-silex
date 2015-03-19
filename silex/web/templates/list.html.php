<?php $view->extend('base-layout.html.php') ?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Übersicht
            </div>
            <ul class="list-group">
                <?php foreach ($posts as $post) : ?>
                    <li class="list-group-item">
                        <strong>
                            <?= $post['title'] ?>
                        </strong>
                        am
                        <em>
                            <?= $post['created_at'] ?>
                        </em>
                        von
                        <em>
                            <?= $post['author'] ?>
                        </em>
                        <br/>
                        <?= implode(' ', array_slice(explode(' ', $post['text']), 0, 10)); ?>
                        <a href="/blog-post/<?= $post['id'] ?>">
                            [...]
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
