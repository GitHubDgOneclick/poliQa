<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntradaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op padding-15">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?> | 
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR || Yii::$app->user->identity->rol == Rol::ROL_EDITOR ): ?>
                    <?= Html::a('Nueva Pregunta', ['create'], ['class' => 'btn btn-success']) ?>
                <?php endif ?>
            <?php endif ?>
        </h1>
    </div>
    <div class="row text-center">
        <div class="col-xs-6 ">
            <div class="panel panel-default">
                <div class="panel-body">
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
