<?php

use yii\helpers\Html;
use app\models\Rol;
use app\models\Aprobaciones;

?>

<div class="panel panel-default">
  	<div class="panel-body">	
		<h4><i class="fa fa-comment-o" aria-hidden="true"></i> <?=$model->titulo_listado?> <small> <?= $model->usuario0->getNombre() ?> | <?= $model->fecha_inicial ?></small></h4>
		<p class="text text-left" ><?= $model->respuesta ?></p>
	</div>
</div>