<?php

/** @var View $this */

/** @var string $content */

use backend\assets\AppAsset;
use yii\web\View;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php
        $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php
    $this->beginBody() ?>
    <main role="main" class="flex-shrink-0">

        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href=" <?= Url::toRoute(['site/index']) ?> "><?= Html::encode(Yii::$app->name) ?></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <?php
                                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form navbar-left'])
                                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-default'],
                                    )
                                    . Html::endForm(); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <?= $content ?>
        </div>
    </main>

    <?php
    $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage();
