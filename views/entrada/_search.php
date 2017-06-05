<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\CadenaAprobacionSearch; 
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use vova07\imperavi\Widget;
/* @var $this yii\web\View */
/* @var $model app\models\EntradaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrada-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'titulo_listado')->textInput() ?>
    <?= $form->field($model, 'descripcion_listado')->textArea(['rows' => '6']) ?>
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
    <?= $form->field($model, 'cadenaAprobacion')->dropDownList(ArrayHelper::map(CadenaAprobacionSearch::all(), 'codigo', 'nombre'),['prompt'=>'Seleccione la cadena a asignar']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
