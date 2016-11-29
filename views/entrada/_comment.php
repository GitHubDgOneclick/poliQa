<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\CadenaAprobacionSearch; 
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */    
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrada-form">

    <?php $form = ActiveForm::begin([
        'action' => ['comment'],
    ]); ?>
        <?= $form->field($model, 'titulo_listado')->textInput(['placeholder' => "Titulo"])->label( false ) ?>
        <?= $form->field($model, 'respuesta')->textArea(['placeholder' => "Comentario",'rows' => '6'])->label( false ) ?>
        <?= $form->field($model, 'pregunta' )->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'descripcion_listado')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'fecha_inicial')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'fecha_final')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'estado')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'tipo')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'usuario')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'categorias')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'palabrasClave')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'cadenaAprobacion')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'entrada')->textInput(['type' => 'hidden'])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton( '<i class="fa fa-floppy-o" aria-hidden="true"></i> Comentar' , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
