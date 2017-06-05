<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CadenaAprobacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cadena-aprobacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'nombre')->textInput(['placeholder' => "nombre"])->label(false) ?>
        <?= $form->field($model, 'estado')->dropDownList([1=>'Activo',0=>'No Activo'],['prompt'=>'Seleccione un estado'])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Filtrar', ['class' => 'btn btn-info']) ?>
            <?= Html::resetButton('<i class="fa fa-paint-brush" aria-hidden="true"></i> limpiar Filtros', ['class' => 'btn btn-danger', 'onclick'=>' limiparFiltros( this ) ' ]) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
