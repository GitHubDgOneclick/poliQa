<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntradaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entradas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op padding-15">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php #echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Nueva Pregunta', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif ?>
    <div class="row text-center">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_item', ['model' => $model]);
            },
        ]) ?>
    </div>
</div>
