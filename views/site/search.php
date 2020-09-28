<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\maxpirali\Menu;
use app\models\maxpirali\MenuItem;
use app\models\Lang;
use yii\widgets\LinkPager;

// var_dump($model);exit;
?>
<div class="row">
	<?php if ($model) :?>
   	<?php foreach($model as $item): ?>
      <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image">
        <a href="<?=Url::to('/?slug='.$item->item->template->slug.'&item_slug='.$item->item->slug)?>">
        <img src="<?=$item->item->photo?>" alt="<?=$item->item->translate->title?>" title="<?=$item->item->translate->title?>" class="img-responsive"></a>
      </div><br><br>
      <div class="caption">
        <a href="<?=Url::to('/?slug='.$item->item->template->slug.'&item_slug='.$item->item->slug)?>" class="prd-name"><?=$item->item->translate->title?></a>        
        <!-- <p class="sku"><strong>Артикул:</strong>01371D-NRBD</p> -->
              <div class="price-container-c">
                  <div>
                  <span class="rozn-price-name"><?=Lang::t('price')?>:</span>
                  <? if($item->item->sale): ?>
                  <span class="price-new"><?=$item->item->price * (1 - $item->item->sale/100)?>   &nbsp;&nbsp;&nbsp;
                    <span class="price-old"><?=$item->item->price?></span></span>
                     <? else: ?>
                     <span class="price-new"><?=$item->item->price?></span>
                     <? endif; ?>
                                  
                </div>
                <div>
                  <span class="opt-price-name">Опт:</span><span class="opt-price-null">--</span>
                </div>        
                <div>
                   <? if($item->item->sale): ?><span class="action-spec test3"></span><? endif; ?>
                </div>          
              </div>
                <button type="button" class="cart-button cart-button-krl" data-id="<?=$item->item->id?>" enabled="enabled"><?=Lang::t("Sotib olish")?></button>
                <!-- Button fastorder -->
              <div class="button-gruop">
                <!-- Button fastorder -->
              <div id="fastorder-form-container5204"></div>
             </div><!-- END :  button fastorder -->
          </div>
    </div>
  </div>
    <? endforeach; ?>
    <?php else:?>
 <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    
      <p class="image">Hech nima topilmadi
      </p>
  
</div>
    <?php endif; ?>	
   </div>