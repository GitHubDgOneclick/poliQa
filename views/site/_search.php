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
        <?= $form->field($model, 'titulo_listado')->textInput(['placeholder' => "¿Pregunta?"])->label(false) ?>
        <?= $form->field($model, 'descripcion_listado')->textInput(['placeholder' => "Respuesta"])->label(false) ?>
        <?= $form->field($model, 'categorias')->textInput(['placeholder' => "Categorias"])->label(false) ?>
        <?= $form->field($model, 'palabrasClave')->textInput(['placeholder' => "Palabras Clave"])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Filtrar', ['class' => 'btn btn-info']) ?>
            <?= Html::resetButton('<i class="fa fa-paint-brush" aria-hidden="true"></i> limpiar Filtros', ['class' => 'btn btn-danger', 'onclick'=>' limiparFiltros( this ) ' ]) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
