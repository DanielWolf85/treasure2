<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Загрузить картинку', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']); ?>
        <?= Html::a('Установить категорию', ['set-category', 'id' => $model->id], ['class' => 'btn btn-default']); ?>
        <?= Html::a('Установить теги', ['set-tags', 'id' => $model->id], ['class' => 'btn btn-default']); ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'data',
            'description:ntext',
            'content:ntext',
            'image',
            'viewed',
            'user_id',
            'category_id',
        ],
    ]) ?>

</div>
