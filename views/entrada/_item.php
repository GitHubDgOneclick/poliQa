<?php

use yii\helpers\Html;
use app\models\Rol;
use app\models\Aprobaciones;

?>
<div class="col-xs-6 ">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="page-header">
				<h4><?=$model->titulo_listado?></h4>
				<small>
					<?= Html::a( '<i class="fa fa-eye" aria-hidden="true"></i> Ver' , ['view', 'id' => $model->codigo], []) ?>
					<?php if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR || Yii::$app->user->identity->rol == Rol::ROL_EDITOR ): ?>
					| <?= Html::a( '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar' , ['update', 'id' => $model->codigo], []) ?>
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
			<?php if ( isset( $model->aprobaciones ) && count( $model->aprobaciones ) > 0 ): ?>
				<h4>% aprobacion</h4>
				<div class="progress">
					<?php $intPorc = 100/count( $model->aprobaciones ); ?>
					<?php foreach ($model->aprobaciones as $key => $aprobacion): ?>
						<?php if ( $aprobacion->estado == Aprobaciones::ESTADO_APROVADO ): ?>
							<div class="progress-bar progress-bar-success" style="width: <?php echo $intPorc.'%'; ?>">
								<?= $aprobacion->eslabonAprobacion->nombre ?>
							</div>
						<?php endif ?>
						<?php if ( $aprobacion->estado == Aprobaciones::ESTADO_NO_APROVADO ): ?>
							<div class="progress-bar progress-bar-danger" style="width: <?php echo $intPorc.'%'; ?>">
								<?= $aprobacion->eslabonAprobacion->nombre ?>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>