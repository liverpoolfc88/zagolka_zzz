<?
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\maxpirali\Menu;
use app\models\maxpirali\MenuItem;
use app\models\Lang;
use yii\widgets\LinkPager;

// var_dump(Yii::$app->request->userIP);exit;
$this->title = $menu->title;

?>

<div id="content" class="col-sm-12">
   <div class="product-large">
      <ul class="breadcrumb">
         <li>
            <a href="<?=Url::to('/')?>">
            <span itemprop="name">
            <?=Lang::t('bosh sahifa')?>
            </span>
            </a>
         </li>
         <li>
            <span itemprop="name">
            <?=$menu->title?>            
        </span>
         </li>
      </ul>
      <div class="row">
         <div id="content" class="col-sm-12">
            <div class="col-sm-7 nopads pcont">
               <ul class="thumbnails">
                  <li class="main-thumb-container">
                  	<? if ($model->sale): ?><span class="action-spec"></span><? endif; ?>
                  	<a class="thumbnail bigimg" href="<?=Url::to($model->photo)?>" title="<?=$model->title?>">
                  		<img src="<?=$model->photo?>" title="<?=$model->title?>" alt="<?=$model->title?>">
                  	</a>
                  </li>

               </ul>
            </div>
            <div class="col-sm-5 blocktobuy">
               <h1 class="product_title"><?=$model->title?></h1>
               <ul class="list-unstyled">
                  <li><?=$model->short?></li>
               </ul>
               ﻿﻿﻿
				<ul class="list-unstyled pricelist">
					<? if($model->sale): ?>
	                  <li class="oldprice"><span style="text-decoration: line-through;"><?=$model->price?></span></li>
		              <li class="currentprice">
		                 <span><?=Lang::t('price')?>: <?=$model->price * (1 - $model->sale/100)?></span>
		              </li>
		            <? else: ?>
		            <li class="currentprice">
		                 <span><?=Lang::t('price')?>: <?=$model->price?></span>
		            </li>
	          		<? endif; ?>
                 </ul>
               <div id="product">
                  <div class="form-group navproduct clearfix">
                     <div class="col-xs-12">
                        <div class="row">
                           <div class="col-xs-12 col-sm-3 nopads qcont">
                              <input type="number" name="quantity" value="1" id="input-quantity" min="1" class="form-control">                  
                              <input type="hidden" id="product_id" value="<?=$model->id?>">
                           </div>
                           <div class="col-xs-9 col-sm-8 nopads">
                              <button type="button" id="button-cart" class="btn btn-primary btn-lg btn-block" ><?=Lang::t("Sotib olish")?></button>
                              ﻿
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-12 nopads ">
               <div class="tab-blocker">
                  <div class="tab-content">
                     <div>
                        <p class="MsoNormal">
                           <?=$model->text?>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<hr>
   <div class="previeCatalog">
      <h3 class="previeCatalog-title">Вам может понравиться</h3>
      <div class="row">
      <?php foreach (MenuItem::getXit($menu->id) as $item) :?>
      <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
         <div class="product-thumb transition">
            <div class="image">
              <a href="<?=Url::to('/?slug='.$menu->slug.'&item_slug='.$item->slug)?>">
                <img src="<?=$item->photo?>" alt="<?=$item->translate->title?>" title="<?=$item->translate->title?>" class="img-responsive">
              </a>
            </div><br><br>
            <div class="caption">
               <a href="<?=Url::to('/?slug='.$menu->slug.'&item_slug='.$item->slug)?>" class="prd-name"><?=$item->translate->title?></a>        
               <div class="price-container-c">
                  <div>
                     <span class="rozn-price-name"><?=Lang::t('price')?>:</span>
                     <? if($item->sale): ?>
                     <span class="price-new"><?=$item->price * (1 - $item->sale/100)?>   &nbsp;&nbsp;&nbsp;<span class="price-old"><?=$item->price?></span></span>
                     <? else: ?>
                     <span class="price-new"><?=$item->price?></span>
                     <? endif; ?>
                  </div>
                  <div>
                     <? if($item->sale): ?><span class="action-spec test3"></span><? endif; ?>
                  </div>
               </div>
               &#65279;
               <button type="button" class="cart-button cart-button-krl" data-id="<?=$item->id?>"><?=Lang::t("Sotib olish")?></button>
            </div>
         </div>
      </div>
      <?php endforeach; ?>

      </div>
   </div>
</div>

<?php
$this->registerJs('

    $("#button-cart").click(function(e){
        e.preventDefault();
        var quantity = $("#input-quantity").val();
        console.log(quantity);
        var items = $("#product_id").val();
        $.get("/site/sale",{item:items, quantity:quantity},function(response){
            
                if(response.result=="success"){
                    window.location.reload();
                    
                    console.log(response.result);
                } else console.log(response.result);
            });
    });
');

?>