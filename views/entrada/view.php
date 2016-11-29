<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Aprobaciones;
use app\models\Rol;
/* @var $this yii\web\View */
/* @var $model app\models\Entrada */

$this->title = $model->titulo_listado;
if (!Yii::$app->user->isGuest){
    if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR || Yii::$app->user->identity->rol == Rol::ROL_EDITOR ) {
        $this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['index']];
    }
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op padding-15">
    <!--<div class="page-header">
        <h1><?= Html::encode($this->title) ?> <small> Desde <?= $model->fecha_inicial ?> | Hasta <?= $model->fecha_final ?> </small></h1>
    </div>-->
    <p>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR || Yii::$app->user->identity->rol == Rol::ROL_EDITOR ): ?>
                <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
                <?php foreach ($model->aprobaciones as $key => $aprobacion): ?>
                    <?php if ( $aprobacion->eslabonAprobacion->usuario == Yii::$app->user->identity->codigo ): ?>
                        <?php if ( $aprobacion->estado == Aprobaciones::ESTADO_NO_APROVADO ): ?>
                            <?= Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i> Aprobar '. $aprobacion->eslabonAprobacion->nombre, ['approve-link', 'id' => $aprobacion->codigo], ['class' => 'btn btn-success']) ?>
                        <?php else: ?>
                            <?= Html::a('<i class="fa fa-window-close-o" aria-hidden="true"></i> Desaprobar '. $aprobacion->eslabonAprobacion->nombre, ['disapprove-link', 'id' => $aprobacion->codigo], ['class' => 'btn btn-danger']) ?>
                        <?php endif ?>
                    <?php endif ?>
                <?php endforeach ?>
                <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar', ['Eliminar', 'id' => $model->codigo], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif ?>
        <?php endif ?>
    </p>
    <p>
        <?= $model->pregunta ?>
    </p>
    <div>
        <?= $model->respuesta ?>
    </div>

</div>
