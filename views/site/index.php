<?

use yii\helpers\Url;
use app\models\Lang;
use app\models\maxpirali\Menu;
use app\models\maxpirali\MenuItem;


$menu = Menu::menus();
// echo "<pre>"; var_dump(Yii::$app->theme); die;
?>
<link rel="stylesheet" type="text/css" href="css/style.min.css">
<div class="col-xs-12 mb40">
    <!-- Start WOWSlider.com BODY section -->
    <div id="wowslider-container1">
        <div class="ws_images">
            <ul>
                <? foreach (\app\models\dilshod\Photo::getPhoto() as $photo): ?>
                    <li>
                        <?='<pre>'; var_dump($photo->getRasm()[0]->src); die; ?>
                        <a href="#">
                            <img src="<?= $photo->getRasm()[0]->src ?>" alt="<?= $photo->info ?>" title="" id="wows1_3"
                                 style="width: 100%"/>
                        </a>
                        <div class="prikh_overlay"><?= $photo->info ?></div>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
        <div class="ws_bullets"></div>
        <div class="ws_script" class="hidewsscript"></div>
        <div class="ws_shadow"></div>
    </div>
    <!-- End WOWSlider.com BODY section -->
</div>

<? foreach ($menu as $m): ?>
    <? $items = MenuItem::getXit($m['id']); ?>
    <? if (count($items) == 0) continue; ?>
    <h3><?= $m['title'] ?></h3>
    <div class="row">
        <? //echo "<pre>"; var_dump($mod); die; ?>
        <?php foreach ($items as $item): ?>
            <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="product-thumb transition">
                    <div class="image">
                        <a href="<?= Url::to('/?slug=' . $menu->slug . '&item_slug=' . $item->slug) ?>">
                            <img src="<?= $item->photo ?>" alt="<?= $item->translate->title ?>"
                                 title="<?= $item->translate->title ?>" class="img-responsive"></a>
                    </div>
                    <div class="caption">
                        <a href="<?= Url::to('/?slug=' . $menu->slug . '&item_slug=' . $item->slug) ?>"
                           class="prd-name"><?= $item->translate->title ?></a>
                        <!-- <p class="sku"><strong>Артикул:</strong>01371D-NRBD</p> -->
                        <div class="price-container-c">
                            <div>
                                <span class="rozn-price-name"><?= Lang::t('price') ?>:</span>
                                <? if ($item->sale): ?>
                                    <span class="price-new"><?= $item->price * (1 - $item->sale / 100) ?>   &nbsp;&nbsp;&nbsp;
                                        <span class="price-old"><?= $item->price ?></span>
                                    </span>
                                <? else: ?>
                                    <span class="price-new"><?= $item->price ?></span>
                                <? endif; ?>

                            </div>
                            <div>
                                <span class="opt-price-name">Опт:</span><span class="opt-price-null">--</span>
                            </div>
                            <div>
                                <? if ($item->sale): ?><span class="action-spec test3"></span><? endif; ?>
                            </div>

                        </div>
                        <?
                        if ($item->status == 0) { ?>
                            <button type="button" class="disabled cart-button cart-button-vrl"
                                    data-id="<?= $item->id ?>"
                                    enabled="enabled"><?= Lang::t("BAzada mavjud emas") ?></button>
                        <? } else { ?>

                            <button type="button" class="cart-button cart-button-krl" data-id="<?= $item->id ?>"
                                    enabled="enabled"><?= Lang::t("Sotib olish") ?></button>
                        <? } ?>
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

<? endforeach; ?>


