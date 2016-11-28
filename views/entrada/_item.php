<?php

use yii\helpers\Html;

?>

	<div class="col-xs-6 ">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<?= Html::a( '<h4>'. $model->titulo_listado . '</h4>' , ['view', 'id' => $model->codigo], []) ?>
				</div>
				<p class="text text-left" ><?= $model->descripcion_listado ?></p>
				<div>
					<ul class="nav nav-pills" role="tablist">
					<?php if ( isset( $model->entradas ) ): ?>
					  	<li class="active">
						  	<a href="#">
						  		<i class="glyphicon glyphicon-comment"></i>&nbsp;
						  		<span class="badge"><?= count( $model->entradas )?></span>
						  	</a>
					 	</li>
					<?php endif ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
