<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use vova07\imperavi\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */    
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrada-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'pregunta')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'respuesta')->widget( Widget::className(), [
            'settings' => [
                'lang' => 'es',
                'minHeight' => 200,
                'fileUpload' => Url::to(['/entrada/file-upload']),
                'imageUpload' => Url::to(['/entrada/image-upload']),
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'filemanager',
                    'imagemanager',
                    'table',
                    'video',
                    'textdirection',
                ]
            ]
        ]) ?>
        <label class="control-label">Valido De - Hasta </label>
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
        <?= $form->field($model, 'estado')->textInput([ 'type' => 'hidden' ])->label( false ) ?>
        <?= $form->field($model, 'tipo')->textInput([ 'type' => 'hidden' ])->label( false ) ?>
        <?= $form->field($model, 'entrada')->textInput([ 'type' => 'hidden' ])->label( false ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
