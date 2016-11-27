<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Entrada;
use app\models\Aprobaciones;

?>
<div class="col-xs-3">
	<div class="panel panel-default">
		<div class="panel-body text-center">
			<div class="page-header">
			  	<h3><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?= ucwords( $model->nombre ) ?></h3>
			</div>
		    <p> <label>Usuario: </label>
		    	<a href="<?=Yii::$app->urlManager->createUrl([ '/usuario/view' , 'id' => $model->usuario0->codigo ])?>">
		    		<i class="fa fa-user-o" aria-hidden="true"></i> <?=$model->usuario0->getNombre()?>
		    	</a>
		    </p>
		    <p class="text-center">
		    	<?= Html::beginForm(['delete', 'id' => $model->codigo], 'post')
                . Html::submitButton(
                    'Eliminar',
                    ['class' => 'btn btn-danger']
                )
                . Html::endForm() ?>
		    </p>
		</div>
	</div>
</div>