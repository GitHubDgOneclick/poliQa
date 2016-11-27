<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CadenaAprobacion */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
	<?php $form = ActiveForm::begin([
        'action' => ['create'],
    ]); ?>
		<div class="col-xs-6 col-xs-offset-2">
		    <?= $form->field($model, 'nombre')->textInput(['placeholder' => 'Nombre Check'])->label( false ) ?>
		</div>
		<div class="col-xs-2">
			<div class="form-group">
				<?= Html::submitButton( '<i class="fa fa-plus-square" aria-hidden="true"></i>', [ 'class' => 'btn btn-success' ]) ?>
			</div>
		</div>
	<?php ActiveForm::end(); ?>
</div>
