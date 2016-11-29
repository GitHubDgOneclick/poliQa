<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Entrada;
use app\models\Aprobaciones;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nombre . ' ' . $model->apellido ;
if (!Yii::$app->user->isGuest){
    if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR ) {
        $this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
    }
}
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
                <?php if ( Yii::$app->user->identity->rol == Rol::ROL_EDITOR || Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR ): ?>
                    <h2 class="panel-title" ><i class="fa fa-file-text-o" aria-hidden="true"></i> Comentarios o Preguntas</h2>
                <?php else: ?>
                    <h2 class="panel-title" ><i class="fa fa-file-text-o" aria-hidden="true"></i> Comentarios</h2>
                <?php endif ?>
            </div>
            <div class="panel-body">
                <ul class="media-list"> 
                <?php if ( isset( $model->entradas ) && count( $model->entradas ) > 0 ): ?>
                    <?php foreach ( $model->entradas as $key => $entrada ): ?>
                        <li class="media"> 
                            <div class="media-body">                             
                                <?php if ( $entrada->tipo == Entrada::TIPO_PREGUNTA ): ?>
                                    <?php if ( Yii::$app->user->identity->rol == Rol::ROL_EDITOR || Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR ): ?>
                                        <h4 class="media-heading">
                                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                             <?= $entrada->titulo_listado ?> | <small>Pregunta</small>
                                        </h4>
                                        <p><?= $entrada->descripcion_listado ?></p>
                                        <p>
                                            <?= Html::a('Ver Pregunta', ['entrada/view', 'id' => $entrada->codigo], ['class' => 'btn btn-primary']) ?>
                                        </p>
                                    <?php endif ?>
                                <?php else: ?>
                                    <h4 class="media-heading"><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $entrada->pregunta ?> | <small>Comentario</small></h4>
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
                                        <h4>
                                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                                            <?= $aprobacion->entrada0->titulo_listado ?> | 
                                            <small>
                                                <?= $eslabon->nombre ?> 
                                                <?php if ( $aprobacion->estado == Aprobaciones::ESTADO_APROVADO): ?>  
                                                    <span class="label label-success">Aprobado</span>
                                                <?php else: ?> 
                                                    <span class="label label-danger">no Aprobado</span>
                                                <?php endif ?>
                                                 | <?= Html::a('<i class="fa fa-eye" aria-hidden="true"></i> Ver Pregunta', ['entrada/view', 'id' => $aprobacion->entrada], []) ?>
                                            </small>
                                        </h4>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex <?= $aprobacion->comentario ?>
                                                </p>
                                                
                                            </div>
                                        </div>
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