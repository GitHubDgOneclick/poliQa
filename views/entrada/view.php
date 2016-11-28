<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */

$this->title = $model->titulo_listado;
$this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op padding-15">
    <!--<div class="page-header">
        <h1><?= Html::encode($this->title) ?> <small> Desde <?= $model->fecha_inicial ?> | Hasta <?= $model->fecha_final ?> </small></h1>
    </div>-->
    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['Eliminar', 'id' => $model->codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p>
        <?= $model->pregunta ?>
    </p>
    <div>
        <?= $model->respuesta ?>
    </div>

</div>
