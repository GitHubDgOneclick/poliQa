<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntradaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'inicio';
?>
<div class="row bg-op padding-15">
    <div class="row text-center">
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header" style="margin: 0px 0 0px;">
                        <h4 style="margin-top: 0px;margin-bottom: 0px;" ><i class="fa fa-search" aria-hidden="true"></i> Filtros</h4>
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
<script type="text/javascript">
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

</script>