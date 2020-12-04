<?


use app\models\ShopcartOrders;
use app\models\Lang;
use yii\helpers\Url;

$this->title = Lang::t('Shopping cart');

// echo "<pre>"; var_dump($items->goods[0]->item->template->id); die;
?>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <form action="checkout" method="post">
        <section class="ptb-70">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-item-table commun-table">
                            <div class="table-responsive">
                                <table class="table-style2">
                                    <tbody>
                                    <tr class="phone-sp text-center">
                                        <th colspan="2"><?= Lang::t('Product Name') ?></th>
                                        <th class="center"><?= Lang::t('Price') ?></th>
                                        <th class="center"><?= Lang::t('Summ') ?></th>
                                        <th class="center"><?= Lang::t('Pieces') ?></th>
                                        <th class=""><?= Lang::t('much') ?></th>
                                        <th class="width-10"><?= Lang::t('Delete') ?></th>

                                    </tr>
                                    <?php if ($items->goods) :?>
                                        <?php foreach ($items->goods as $item) : ?>
                                            <tr class="phone-sp">
                                                <td>
                                                    <a href="<?=Url::to('/?slug='.$item->item->template->slug.'&item_slug='.$item->item->slug)?>">
                                                        <img src="<?= $item->item->photo ?>" style="width: 150px">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?=Url::to('/?slug='.$item->item->template->slug.'&item_slug='.$item->item->slug)?>">
                                                        <h4 class="product_title"><?= $item->item->title?>&nbsp;<span>(<?=$item->item->template->title?>)</span></h4>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <? if($item->item->sale): ?>
                                                        <span class="price-new"><?=$item->item->price * (1 - $item->item->sale/100)?>   &nbsp;&nbsp;&nbsp;</span>
                                                        <span class="price-old"><?=$item->item->price?></span>
                                                    <? else: ?>
                                                        <span class="price-new"><?=$item->item->price?></span>
                                                    <? endif; ?>
                                                </td>
                                                <td>
                                                    <?=$item->price * (1 - $item->sale/100) * $item->count?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($item->pieces==NULL){?>
                                                        <b>
                                                            <?= Lang::t('dona') ?>
                                                        </b>
                                                    <?}else {?>
                                                        <b>
                                                            <?= Lang::t('pachkada') ?>
                                                        </b>
                                                        <br>
                                                        <?=$item->pieces?>
                                                        <?= Lang::t('  ta bor') ?>
                                                    <?}?>

                                                </td>
                                                <td  style='width:10%'>
                                                    <input type="number" name="quantity" data-id="<?=$item->item->id?>" min="1" class="input-quantity form-control" value="<?=$item->count?>">
                                                </td>
                                                <td class="text-center"><a class="remove-item remove" href="#"      data-id="<?=$item->good_id?>" data-value="<?= $item->price  ?>" title="<?= Lang::t('Remove Item From Cart') ?>">
                                                        <button type="button" data-id="169" title="Remove" class="btn btn-danger delete"><i class="fa fa-times-circle"></i></button></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                    </tbody>
                                    <tfoot>
                                    <tr style="border-top:solid">
                                        <td colspan="3"><h4><?= Lang::t('Total Cost') ?></h4></td>
                                        <td class="width-90 summa"><h4><b><?= $items->cost ?></b></h4></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="">
                                    <a class="btn btn-danger left" href="<?//= $this->to('catalog/books') ?>"><?= Lang::t('Continue Shopping') ?></a>
                                    <a class="btn btn-danger main-bg right" href="<?=Url::to(['site/complete'])?>"><?= Lang::t('Proceed to Checkout') ?></a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </form>
    <p></p>
<?php

$this->registerJs('
    $(".input-quantity").focusout(function(e){
        e.preventDefault();
        var quantity = $(this).val();
        var items = $(this).data("id");
        console.log(items);
        $.get("/site/sale",{item:items, quantity:quantity},function(response){
            
                if(response.result=="success"){
                    window.location.reload();
                    
                    console.log(response.result);
                } else console.log(response.result);
            });
    });
    $(".remove").click(function(e){
        e.preventDefault();
        var data = $(this).attr("data-id");
        // var value = $(this).attr("data-value");
        // var summa = $(".summa b").html();
        // value = Number(value);
        // summa = Number(summa);
        console.log(data);
        $.get("/site/delete",{good_id: data},function(response){
            if(response.result=="success") {console.log("success");
            window.location.reload();}
            else console.log(response.result);
            //$(".summa b").html(summa-value);
        });
        
    });
');

?>