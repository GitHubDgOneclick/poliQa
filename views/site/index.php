<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntradaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'inicio';
?>
<div class="row bg-op padding-15">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?>
    </div>
    <div class="row text-center">
        <div class="col-xs-4 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header" style="margin: 0px 0 0px;">
                        <h4 style="margin-top: 0px;margin-bottom: 0px;" ><i class="fa fa-search" aria-hidden="true"></i> Filtros</h4>
                    </div>
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_item', ['model' => $model]);
            },
        ]) ?>
    </div>
</div>
