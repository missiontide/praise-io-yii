<?php

/** @var yii\web\View $this */

$this->title = 'praise.io api';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">praise-io-yii</h1>

        <p>
            <h2>Usage</h2>
        </p>
        <p><b><a href="/song">/song</a></b>: GridView of Songs</p>
        <p><b><a href="/song/all">/song/all</a></b>: all Songs in json response</p>
        <p><b><a href="/song/lyrics?ids=1,2,3">/song/lyrics?ids=</a></b>: $ids = comma-delineated ids of Songs</p>

        <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
    </div>
</div>
