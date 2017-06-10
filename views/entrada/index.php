<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntradaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row bg-op padding-15">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?> | 
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR || Yii::$app->user->identity->rol == Rol::ROL_EDITOR ): ?>
                    <?= Html::a('Nueva Pregunta', ['create'], ['class' => 'btn btn-success']) ?>
                <?php endif ?>
            <?php endif ?>
        </h1>
    </div>
    <div class="row text-center">

        <div class="col-xs-4 ">
            <br />
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h4>Filtros</h4>
                        <small>
                        </small> 
                    </div>
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_item', ['model' => $model]);
            },
        ]) ?>
    </div>
</div>
<?php
$script = <<< JS
    $(document).ready(function(){
        igualarAltoItems($(".panel.panel-default"));
    });

    function igualarAltoItems(objeto){
        var maxHeight = 150;
        //CICLO IMG
        // objeto.each(function(i){
        //  var obj = $(this);
        //  if(obj.height()>maxHeight){
        //      maxHeight = obj.height();
        //  }
        // });
        for (var i = objeto.length - 1; i >= 0; i--) {
            var obj = $(objeto[i]);
            if(obj.height()>maxHeight){
                maxHeight = obj.height();
            }
        };
        maxHeight = maxHeight+1;
        //ASIGNAR HEIGHT A LOS DEMÁS ELEMENTOS
        objeto.css("height",maxHeight);
    }
JS;
$this->registerJs($script);
?>