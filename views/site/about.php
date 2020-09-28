<?php
use app\models\Lang;


use yii\helpers\Html;

$this->title = Lang::t('about');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
    	<img style="height: 250px; border-radius: inherit; border: solid 1px; border-color: red; margin: 20px; padding: 20px" src="/img/favicon-96x96.png">
    	<p style="font-size: 15px !important;">
    		<span>                
            <?=Lang::t('about-a')?>
            </span>

    	</p>
    </div>

   <!--  <p>
        This is the About page. You may modify the following file to customize its content:
    </p> -->

    <!-- <code><?= __FILE__ ?></code> -->
</div>
