<?php

use yii\helpers\Html;

?>
<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h4><?= $model->pregunta ?> <small> </small></h4>
				</div>
				<p><?= substr( strip_tags($model->respuesta) , 0, 250 ).'...' ?></p>
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
</div>