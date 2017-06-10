<?php

use yii\helpers\Html;
use app\models\Rol;
use app\models\Aprobaciones;

?>
<div class="col-xs-4">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="page-header">
				<h4><?=$model->titulo_listado?></h4>
				<small>
					<?= Html::a( '<i class="fa fa-eye" aria-hidden="true"></i> Ver' , ['entrada/view', 'id' => $model->codigo], []) ?>
					<?php if (!Yii::$app->user->isGuest): ?>
						<?php if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR || Yii::$app->user->identity->rol == Rol::ROL_EDITOR ): ?>
						| <?= Html::a( '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar' , ['entrada/update', 'id' => $model->codigo], []) ?>
						<?php endif ?>
					<?php endif ?>
				</small> 
			</div>
			<p class="text text-left" ><?= $model->descripcion_listado ?></p>
			<div>
				<ul class="nav nav-pills" role="tablist">
				<?php if ( isset( $model->entradas ) ): ?>
				  	<li class="active">
					  	<a href="#">
					  		<i class="fa fa-comments" aria-hidden="true"></i>&nbsp;
					  		<span class="badge"><?= count( $model->entradas )?></span>
					  	</a>
				 	</li>
				<?php endif ?>
				</ul>
			</div>
		</div>
	</div>
</div>