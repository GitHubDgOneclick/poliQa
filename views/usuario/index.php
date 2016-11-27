<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado de usuarios';
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
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                        'codigo',
                        'nombre',
                        'apellido',
                        'email:email',
                        'usuario',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions'=>['class'=>'text text-center'],
                        'template' => '{view} {change-editor} {change-user}',
                        'buttons' => [
                            'change-editor' => function ($url, $model) {
                                if($model->rol == Rol::ROL_USUARIO ){
                                    return Html::a('<i class="fa fa-user-o" aria-hidden="true"></i>', $url, [
                                        'title' => 'Cambiar a Editor',
                                    ]);
                                }
                            },
                            'change-user' => function ($url, $model) {
                                if($model->rol == Rol::ROL_EDITOR ){
                                    return Html::a('<i class="fa fa-users" aria-hidden="true"></i>', $url , [
                                                'title' => 'Cambiar a Usuario',
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
