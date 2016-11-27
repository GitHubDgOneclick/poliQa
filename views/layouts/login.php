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
                <div id="alerts" class="col-lg-offset-3 col-lg-6">
                    <?php foreach ( Yii::$app->session->getAllFlashes() as $key => $message ): ?>
                        <div class="alert alert-<?= $key ?>" role="alert"><?= $message ?></div>
                    <?php endforeach ?>
                </div>               
            </div>
            <?= $content ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
