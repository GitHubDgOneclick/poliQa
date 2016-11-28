<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\cadenaAprobacionSearch; 
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */    
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrada-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'titulo_listado')->textInput() ?>
        <?= $form->field($model, 'descripcion_listado')->textArea(['rows' => '6']) ?>
        <?= $form->field($model, 'pregunta')->widget( Widget::className(), [
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
        <?= $form->field($model, 'categorias')->textInput() ?>
        <?= $form->field($model, 'palabrasClave')->textInput() ?>
        <?= $form->field($model, 'cadenaAprobacion')->dropDownList(ArrayHelper::map(cadenaAprobacionSearch::all(), 'codigo', 'nombre'),['prompt'=>'Seleccione un rol']) ?>

        <?= $form->field($model, 'estado')->textInput([ 'type' => 'hidden' ])->label( false ) ?>
        <?= $form->field($model, 'tipo')->textInput([ 'type' => 'hidden' ])->label( false ) ?>
        <?= $form->field($model, 'entrada')->textInput([ 'type' => 'hidden' ])->label( false ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
