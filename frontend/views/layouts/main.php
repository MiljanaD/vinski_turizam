<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
$this->registerJs("
$(document).ready( function() {
$('.admin-dropdown').find('a').attr('disabled', true);
    $('.admin-dropdown').find('a').addClass('show');
    $('.admin-dropdown').find('.dropdown-menu').addClass('show');
 })
");
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100 main-layout"
          style="background-image: url(<?= \yii\helpers\Url::to('@web/images/vineFlip.jpg') ?>); background-size: cover">
    <?php $this->beginBody() ?>
    <div class="d-flex">
        <?= Nav::widget([
            'options' => ['class' => 'pt-3 pb-5 side-nav col-auto col-md-3 col-xl-2 px-0 nav flex-column min-vh-100'],
            'items' => [
                ['label' => '<h1 class="text-center font-weight-bolder text-white">VINSKIT</h1>', 'disabled' => true],
                ['label' => '<h5 class="mb-3 text-uppercase">pocetna stranica</h5>', 'url' => ['/site/index']],
                ['label' => '<h5 class="mb-3 text-uppercase">vinarije</h5>', 'url' => ['/winery/index']],
                ['label' => '<h5 class="text-uppercase">ADMIN</h5>',
                    'items' => [
                        ['label' => '<h5 class="mb-3 text-uppercase">korisnici</h5>', 'url' => ['/user/index']],
                        ['label' => '<h5 class="mb-3 text-uppercase">vinski regioni</h5>', 'url' => ['/vine-region/index']],
                        ['label' => '<h5 class="mb-3 text-uppercase">vinske sorte</h5>', 'url' => ['/vine-sort/index']],
                        ['label' => '<h5 class="mb-3 text-uppercase">usluge vinarija</h5>', 'url' => ['/vine-service/index']],
                    ],
                    'visible' => Yii::$app->session->get('admin'),
                    'options' => ['class' => 'admin-dropdown']
                ],
                ['label' => '<h5 class="mb-3 text-center text-uppercase text-wrap"><span >Odjavi se </span><div><i class="far fa-user me-2"></i>' . Yii::$app->user->identity->name . " " . Yii::$app->user->identity->surname . '</div></h5>',
                    'url' => ['/site/logout'],
                    'options' => ['class' => 'position-absolute bottom-0 pb-3']
                ],
            ],
            'encodeLabels' => false,

        ]) ?>

        <main role="main" class="h-100 w-100 p-4">
            <div class="content-wrapper h-100">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <footer class="footer mt-auto py-3 text-muted">

        </footer>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
