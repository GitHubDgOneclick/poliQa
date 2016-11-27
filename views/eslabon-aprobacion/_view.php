<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Entrada;
use app\models\Aprobaciones;

?>
<div class="col-xs-3">
	<div class="panel panel-default">
		<div class="panel-body">
		    <h1 class="text-center"><?= $model->nombre ?></h1>
		    <p>Usuario encargado: <?=$model->usuario0->getNombre()?></p>
		    <p class="text-center">
		        <?= Html::a('<i class="fa fa-times" aria-hidden="true"></i>', ['delete', 'id' => $model->codigo], ['class' => 'btn btn-danger']) ?>
		    </p>
		</div>
	</div>
</div>