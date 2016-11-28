<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Entrada;
use app\models\Aprobaciones;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nombre . ' ' . $model->apellido ;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>   
                <?= $model->getNombre() ?> | 
                <small><?= $model->rol0->nombre ?></small>
            </h1>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title" > <i class="fa fa-user-circle-o" aria-hidden="true"></i> Datos del usuario</h1>
            </div>
            <div class="panel-body">
                <p><label>nombre: </label> <?= $model->nombre ?> </p>
                <p><label>apellido: </label> <?= $model->apellido ?> </p>
                <p><label>email: </label> <?= $model->email ?> </p>
                <p><label>usuario: </label> <?= $model->usuario ?> </p>
                <p><label>rol: </label> <?= $model->rol0->nombre ?> </p>
            </div>
        </div>
    </div>
    <div class="col-xs-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title" ><i class="fa fa-file-text-o" aria-hidden="true"></i> Comentarios o Preguntas</h2>
            </div>
            <div class="panel-body">
                <ul class="media-list"> 
                <?php if ( isset( $model->entradas ) && count( $model->entradas ) > 0 ): ?>
                    <?php foreach ( $model->entradas as $key => $entrada ): ?>
                        <li class="media"> 
                            <div class="media-body">                             
                                <?php if ( $entrada->tipo == Entrada::TIPO_PREGUNTA ): ?>
                                    <h4 class="media-heading"><i class="fa fa-question-circle-o" aria-hidden="true"></i> <?= $entrada->pregunta ?> | <small>Pregunta</small></h4>
                                    <p><?= substr( strip_tags( $entrada->respuesta ) , 0, 250 ).'...' ?></p>
                                    <p>
                                        <?= Html::a('Ver Pregunta', ['entrada/view', 'id' => $entrada->codigo], ['class' => 'btn btn-primary']) ?>
                                    </p>
                                <?php else: ?>
                                    <h6 class="media-heading"><?= $entrada->pregunta ?> | <small>Comentario</small></h6>     
                                    <p>
                                        <?= $entrada->respuesta;?>
                                    </p>
                                <?php endif ?>
                            </div> 
                        </li> 
                    <?php endforeach ?>
                <?php else: ?>
                    <li class="media"> 
                        <div class="media-body"> 
                            <p>El Usuario no tiene Comentarios o Preguntas Registradas </p> 
                        </div> 
                    </li> 
                <?php endif ?>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Aprobaciones</h1>
            </div>
            <div class="panel-body">
                <ul class="media-list"> 
                <?php if ( isset( $model->eslabonAprobacions ) && count( $model->eslabonAprobacions ) > 0 ): ?>
                    <?php foreach ( $model->eslabonAprobacions as $key => $eslabon ): ?>
                        <?php if ( isset( $eslabon->aprobaciones ) && count( $eslabon->aprobaciones ) > 0 ): ?>
                            <?php foreach ( $eslabon->aprobaciones  as $key => $aprobacion ): ?>
                                <li class="media"> 
                                    <div class="media-body">                             
                                        <h1><?= $aprobacion->entrada0->pregunta ?></h1>
                                        <p> <?= $eslabon->nombre ?> | 
                                            <?php if ( $aprobacion->estado == Aprobaciones::ESTADO_APROVADO): ?>  
                                                <span class="label label-success">Aprobado</span>
                                            <?php else: ?> 
                                                <span class="label label-danger">no Aprobado</span>
                                            <?php endif ?>
                                        </p>
                                        <?php if ( $aprobacion->estado == Aprobaciones::ESTADO_APROVADO): ?>  
                                            <p>
                                                <?= $aprobacion->comentario ?>
                                            </p>
                                        <?php else: ?>
                                            <p class="text-center">
                                                <?= Html::a('Ver Pregunta', ['entrada/view', 'id' => $aprobacion->entrada], ['class' => 'btn btn-primary']) ?>
                                            </p>
                                        <?php endif ?>
                                    </div> 
                                </li> 
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php else: ?>
                    <li class="media"> 
                        <div class="media-body"> 
                            <p>El Usuario No Tiene Aprobaciones Registradas </p> 
                        </div> 
                    </li> 
                <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</div>