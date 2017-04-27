<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Dropdown;
use app\models\Rol;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="bg-login">
        <?php $this->beginBody() ?>
        <div class="container">
            <div class="row bg-op row-nav">
                <?php
                    if (!Yii::$app->user->isGuest){
                        $itemMenu = [];
                        array_push( $itemMenu , '<li><a href="'.Yii::$app->urlManager->createUrl([ '/usuario/view' , 'id' => Yii::$app->user->identity->codigo  ]).'"><i class="fa fa-user-o" aria-hidden="true"></i> Ver Perfil</a></li>' );
                        if ( Yii::$app->user->identity->rol == Rol::ROL_ADMINISTRADOR ){
                            array_push( $itemMenu , '<li><a href="'.Yii::$app->urlManager->createUrl(['/usuario/index']).'"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a></li>');
                            array_push( $itemMenu , '<li><a href="'.Yii::$app->urlManager->createUrl(['/cadena-aprobacion']).'"><i class="fa fa-check-square-o" aria-hidden="true"></i> Cheks de Aprobacion</a></li>');
                        } else if ( Yii::$app->user->identity->rol == Rol::ROL_EDITOR ) {
                            array_push( $itemMenu , '<li><a href="'.Yii::$app->urlManager->createUrl([ '/entrada/' ]).'"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Preguntas</a></li>');
                        } else if ( Yii::$app->user->identity->rol == Rol::ROL_USUARIO ) {}
                        array_push( $itemMenu , '<li role="separator" class="divider"></li>');
                        array_push( $itemMenu , '<li><a href="'.Yii::$app->urlManager->createUrl(['usuario/logout']).'"><i class="fa fa-reply" aria-hidden="true"></i> Cerrar sesion</a></li>');
                    }
                ?>
                <?php
                NavBar::begin([
                    'brandLabel' => Html::img('@web/img/Logo-poli.png', ['alt'=> 'PoliQa', 'style'=>'width: 45px;top: -14px;position: relative;' ]),
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar navbar-default',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-left'],
                    'items' => [
                        '<li class="">'.
                            '<h3 style="margin-top: 12px;">PoliQa</h3>'.
                        '</li>'
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        Yii::$app->user->isGuest ? (
                            ['label' => 'Login', 'url' => ['/usuario/login']]
                        ) : (
                            '<li class="dropdown">'.
                                '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.
                                   Yii::$app->user->identity->getNombre() . '('. Yii::$app->user->identity->rol0->nombre .') <span class="caret"></span>'.
                                '</a>'.
                                Dropdown::widget([
                                    'items' => $itemMenu
                                    ,'options' => [
                                        'class' => 'dropdown-menu',
                                    ]
                                ]).
                            '</li>'
                        )
                    ],
                ]);
                NavBar::end();
                ?>
            </div>
            <div class="row bg-op">
                <div id="alerts" class="col-lg-offset-3 col-lg-6">
                    <?php foreach ( Yii::$app->session->getAllFlashes() as $key => $message ): ?>
                        <div class="alert alert-<?= $key ?>" role="alert"><?= $message ?></div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="row bg-op">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
            <?= $content ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
