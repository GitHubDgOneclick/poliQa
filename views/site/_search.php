<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EntradaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrada-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'pregunta') ?>
        <?= $form->field($model, 'respuesta') ?>
        <div class="form-group field-entradasearch-respuesta">
            <label class="control-label">Valides</label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'fecha_inicial',
                'attribute2' => 'fecha_final',
                'options' => ['placeholder' => 'Fecha de inicio'],
                'options2' => ['placeholder' => 'Fecha de Fin'],
                'type' => DatePicker::TYPE_RANGE,
                'form' => $form,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                ]
            ]) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Filtrar', ['class' => 'btn btn-info']) ?>
            <?= Html::resetButton('<i class="fa fa-paint-brush" aria-hidden="true"></i> limpiar Filtros', ['class' => 'btn btn-danger', 'onclick'=>' limiparFiltros( this ) ' ]) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
