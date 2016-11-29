<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\CadenaAprobacion;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CadenaAprobacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Check's de aprobacion";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op">
    <div class="col-xs-12">
        <div class="col-xs-4 padding-15">
            <div class="page-header">
                <h2>Filtros</h2>
            </div>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="col-xs-8 padding-15">
            <div class="page-header">
                <h2><?= Html::encode($this->title) ?></h2>
            </div>
            <?php echo $this->render('_form', ['model' => $model]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'rowOptions' => function( $model ){
                        if ( $model->estado == CadenaAprobacion::ESTADO_ACTIVO  ) {
                            return [ 'class' => 'success' ];
                        } else {
                            return [ 'class' => 'danger' ];
                        }
                    },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'nombre',
                        [
                            'attribute' => 'estado',
                            'value' => function ( $model ) {
                                if ( $model->estado == CadenaAprobacion::ESTADO_ACTIVO  ) {
                                    return 'Activo';
                                } else {
                                    return 'No Activo';
                                }
                            },
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions'=>['class'=>'text text-center'],
                            'template' => '{view} {change-active} {change-no-active}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', ['/eslabon-aprobacion/index' , 'cadena'=> $model->codigo ] , [
                                        'title' => 'Ver',
                                    ]);
                                },
                                'change-active' => function ($url, $model) {
                                    if ($model->estado == CadenaAprobacion::ESTADO_INACTIVO) {
                                        return Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i>', $url, [
                                            'title' => 'Activar Check',
                                        ]);
                                    }
                                },
                                'change-no-active' => function ($url, $model) {
                                    if ($model->estado == CadenaAprobacion::ESTADO_ACTIVO) {
                                        return Html::a('<i class="fa fa-times" aria-hidden="true"></i>', $url, [
                                                    'title' => 'Desactivar Check',
                                        ]);
                                    }
                                },
                            ],
                        ],
                    ],
                ]); ?>
        </div>    
    </div>
</div>