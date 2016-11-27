<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EslabonAprobacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eslabones de aprobacion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op padding-15">
	<div class="page-header">
    	<h1><?= Html::encode($this->title) ?></h1>
	</div>
    <div class="col-xs-8 col-xs-offset-2">
    	<?= $this->render('_form', ['model' => $model]); ?>
    </div>
    <div class="col-xs-12">
        <?php Pjax::begin(['id' => 'eslabones']) ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_view', ['model' => $model]);
            },
        ]) ?>
        <?php Pjax::end() ?>
    </div>
</div>
