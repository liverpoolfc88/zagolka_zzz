<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

            <base href="<?=Url::home(true)?>" />
            <meta name="description" content="<??>" />
            <meta name="keywords" content= "<??>" />
            <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">



    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title)?></title>
    <?php $this->head() ?>
</head>
<body style="background: white !important;" class="common-home">
<?php $this->beginBody() ?>

    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
    
    <div class="container">
        <div class="row">
            <aside id="column-left" class="col-sm-3 hidden-xs">
                <?=Yii::$app->controller->renderPartial("//layouts/left")?>
            </aside>
            <div id="content" class="col-sm-9">
                <?= $content ?>
            </div>
        </div>
    </div>
<?=Yii::$app->controller->renderPartial("//layouts/footer")?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
