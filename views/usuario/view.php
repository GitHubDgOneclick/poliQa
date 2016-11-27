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
    <div class="col-xs-4">
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="col-xs-8">
        <div class="page-header">
            <h2>Comentarios o Preguntas</h2>
            <ul class="media-list"> 
            <?php if ( isset( $model->entradas ) && count( $model->entradas ) > 0 ): ?>
                <?php foreach ( $model->entradas as $key => $entrada ): ?>
                    <li class="media"> 
                        <div class="media-body">                             
                            <?php if ( $entrada->tipo == Entrada::TIPO_PREGUNTA ): ?>
                                <h4 class="media-heading"><?= $entrada->pregunta ?> | <small>Pregunta</small></h4>     
                                <p>
                                    <?= Html::a('Ver Pregunta', ['entrada/view', 'id' => $entrada->codigo], ['class' => 'btn btn-primary']) ?>
                                </p>
                            <?php else: ?>
                                <h4 class="media-heading"><?= $entrada->pregunta ?> | <small>Comentario</small></h4>     
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
                        <h4 class="media-heading">El Usuario no tiene Comentarios o Preguntas Registradas </h4> 
                    </div> 
                </li> 
            <?php endif ?>
            </ul>
        </div>
         <div class="page-header">
            <h2>Aprobaciones</h2>
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
                                        <?php endif ?>
                                        <?php if ( $aprobacion->estado == Aprobaciones::ESTADO_NO_APROVADO): ?>                                
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
                <?php endforeach ?>
            <?php else: ?>
                <li class="media"> 
                    <div class="media-body"> 
                        <h4 class="media-heading">El Usuario No Tiene Aprobaciones Registradas </h4> 
                    </div> 
                </li> 
            <?php endif ?>
            </ul>
        </div>
    </div>
</div>