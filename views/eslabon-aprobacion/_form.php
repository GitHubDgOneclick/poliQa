<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UsuarioSearch;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\models\EslabonAprobacion */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
$this->registerJs(
   '$("document").ready(function(){ 
        $("#nuevo_eslabon").on("pjax:end", function() {
            $.pjax.reload({container:"#eslabones"});  //Reload GridView
        });
    });'
);
?>
<div class="row">
    <?php yii\widgets\Pjax::begin(['id' => 'nuevo_eslabon']) ?>
        <?php $form = ActiveForm::begin([
            'action' => ['create'],
        ]); ?>
            <div class="col-xs-4 col-xs-offset-1">
                <?= $form->field($model, 'nombre')->textInput( [ 'placeholder' => "nombre" ] )->label( false ) ?>
            </div>
            <div class="col-xs-5">
                <?= $form->field($model, 'usuario')->dropDownList(ArrayHelper::map( UsuarioSearch::allEditors(), 'codigo', 'usuario'),['prompt'=>'Seleccione un usuario'])->label(false) ?>
            </div>
            <div class="col-xs-1">
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-plus" aria-hidden="true"></i>' , ['class' => 'btn btn-success' ]) ?>
                </div>
            </div>
            <?= $form->field($model, 'cadena_aprobacion')->textInput(['type'=>'hidden'])->label(false) ?>
        <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>
</div>
