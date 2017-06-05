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

    <?= $form->field($model, 'titulo_listado')->textInput(['placeholder' => "Titulo"])->label(false) ?>
    <?= $form->field($model, 'descripcion_listado')->textInput(['placeholder' => "Descripcion"])->label(false) ?>
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
    <?= $form->field($model, 'categorias')->textInput(['placeholder' => "Categorias"])->label(false) ?>
    <?= $form->field($model, 'palabrasClave')->textInput(['placeholder' => "Palabras Clave"])->label(false) ?>

    <div class="form-group">
        <div class="form-group">
            <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Filtrar', ['class' => 'btn btn-info']) ?>
            <?= Html::resetButton('<i class="fa fa-paint-brush" aria-hidden="true"></i> limpiar Filtros', ['class' => 'btn btn-danger', 'onclick'=>' limiparFiltros( this ) ' ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
