<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Inicio De Sesión Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-4 col-sm-offset-8 bg-op padding-15">
        <div class="page-header">
            <h1>Bienvenido a Poli QaQa<small></small></h1>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal bg-op padding-15'],
            'fieldConfig' => [
                'template' => "{label}{input}{error}",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>
        <?= $form->field($model, 'username')->input('usuario', ['placeholder' => "nombre de usuario"])->label( false ) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Contraseña"])->label( false ) ?>
        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->checkbox()->label('Recordarme') ?>
        <div class="form-group text center">
            <?= Html::submitButton('iniciar sesión', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
