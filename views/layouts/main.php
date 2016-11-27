<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
            <div class="row bg-op">
                <?php
                NavBar::begin([
                    'brandLabel' => 'PoliQa',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar navbar-default',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        Yii::$app->user->isGuest ? (
                            ['label' => 'Login', 'url' => ['/site/login']]
                        ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
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
