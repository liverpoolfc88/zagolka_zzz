<?php
use app\models\Lang;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = Lang::t('new');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>
   <?=$this->title?>
 </h1>

    <div class="row">
   	<?php foreach($model as $item): ?>
        <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image">
        <a href="<?=Url::to('/?slug='.$menu->slug.'&item_slug='.$item->slug)?>">
        <img src="<?=$item->photo?>" alt="<?=$item->translate->title?>" title="<?=$item->translate->title?>" class="img-responsive"></a>
      </div>
      <div class="caption">
        <a href="<?=Url::to('/?slug='.$menu->slug.'&item_slug='.$item->slug)?>" class="prd-name"><?=$item->translate->title?></a>        
        <!-- <p class="sku"><strong>Артикул:</strong>01371D-NRBD</p> -->
              <div class="price-container-c">
                  <div>
                  <span class="rozn-price-name"><?=Lang::t('price')?>:</span>
                  <? if($item->sale): ?>
                  <span class="price-new"><?=number_format($item->price * (1 - $item->sale/100), 2, ',', ' ');?>   &nbsp;&nbsp;&nbsp;
                    <span class="price-old"><?=number_format($item->price, 2, ',', ' ')?></span></span>
                     <? else: ?>
                     <span class="price-new"><?=$item->price?></span>
                     <? endif; ?>
                                  
                </div>
                <div>
                  <span class="opt-price-name">Опт:</span><span class="opt-price-null">--</span>
                </div>
                <div>
                  <? if($item->sale): ?><span class="action-spec test3"></span><? endif; ?>
                </div>

              </div>
                <?
              if ($item->status==0) {?>
               <button type="button" class="cart-button cart-button-vrl" data-id="<?=$item->id?>" enabled="enabled"><?=Lang::t("BAzada mavjud emas")?></button>
             <? } else {?>
              
                <button type="button" class="cart-button cart-button-krl" data-id="<?=$item->id?>" enabled="enabled"><?=Lang::t("Sotib olish")?></button>
                <?}?>
                <!-- Button fastorder -->
              <div class="button-gruop">
                <!-- Button fastorder -->
              <div id="fastorder-form-container5204"></div>
             </div><!-- END :  button fastorder -->
          </div>
    </div>
  </div>
    <? endforeach; ?>
   </div>
  		