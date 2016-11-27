<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'nombre')->input('nombre', ['placeholder' => "nombre"])->label(false) ?>
        <?= $form->field($model, 'apellido')->input('apellido', ['placeholder' => "apellido"])->label(false) ?>
        <?= $form->field($model, 'email')->input('email', ['placeholder' => "email"])->label(false) ?>
        <?= $form->field($model, 'usuario')->input('usuario', ['placeholder' => "nombre de usuario"])->label(false) ?>
        <?= $form->field($model, 'rol')->dropDownList(ArrayHelper::map(Rol::all(), 'codigo', 'nombre'),['prompt'=>'Seleccione un rol'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Filtrar', ['class' => 'btn btn-info']) ?>
        <?= Html::resetButton('<i class="fa fa-paint-brush" aria-hidden="true"></i> limpiar Filtros', ['class' => 'btn btn-danger', 'onclick'=>' limiparFiltros( this ) ' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
