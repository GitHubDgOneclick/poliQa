<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CadenaAprobacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadena Aprobacions';
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
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'nombre',
                        'estado',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions'=>['class'=>'text text-center'],
                            'template' => '{view} {change-editor} {change-user}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', ['/eslabon-aprobacion/index' , 'cadena'=> $model->codigo ] , [
                                        'title' => 'Ver',
                                    ]);
                                },
                                'change-editor' => function ($url, $model) {
                                   
                                        return Html::a('<i class="fa fa-user-circle-o" aria-hidden="true"></i>', $url, [
                                            'title' => 'Cambiar a Editor',
                                        ]);
                                    
                                },
                                'change-user' => function ($url, $model) {
                                    
                                        return Html::a('<i class="fa fa-users" aria-hidden="true"></i>', $url, [
                                                    'title' => 'Cambiar a Usuario',
                                        ]);

                                },
                            ],
                        ],
                    ],
                ]); ?>
        </div>    
    </div>
</div>