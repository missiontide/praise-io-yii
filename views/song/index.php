<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Song;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SongSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Songs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="song-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= !Yii::$app->user->isGuest ? Html::a('Create Song', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'artist',
            'lyrics:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Song $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => !Yii::$app->user->isGuest ? '{view} {update} {delete}' : '{view}',
            ],
        ],
    ]); ?>


</div>
