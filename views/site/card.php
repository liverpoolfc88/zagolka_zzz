<?


use app\models\ShopcartOrders;
use app\models\Lang;
use yii\helpers\Url;

$this->title = Lang::t('Shopping cart');

// echo "<pre>"; var_dump($items->goods[0]->item->template->id); die;
?>
<style >
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

</style>
<!--<section>-->
<!--    <div class="row">-->
<!--        --><?php //if ($items->goods) :?>
<!--        --><?php //foreach ($items->goods as $key=> $item) : ?>
<!--        <div class="col-sm-6 col-md-4">-->
<!--            <div class="thumbnail">-->
<!--                <img src="--><?//= $item->item->photo ?><!--" alt="...">-->
<!--                <div class="caption">-->
<!--                    <a href="--><?//=Url::to('/?slug='.$item->item->template->slug.'&item_slug='.$item->item->slug)?><!--">-->
<!--                        <h5>--><?//= $item->item->title?><!--/<span>(--><?//=$item->item->template->title?><!--)</span></h5>-->
<!--                    </a>-->
<!--                    <p>...</p>-->
<!--                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--            --><?php //endforeach; ?>
<!--        --><?php //endif;?>
<!--    </div>-->
<!--</section>-->
<!--<hr>-->
<div style="overflow-x:auto;">
    <table id="customers">

        <tr>
            <th colspan="2"><?= Lang::t('Product Name') ?></th>
            <th class="center"><?= Lang::t('Price') ?></th>
            <th class="center"><?= Lang::t('Summ') ?></th>
            <th class="center"><?= Lang::t('Pieces') ?></th>
            <th class=""><?= Lang::t('much') ?></th>
            <th class="width-10"><?= Lang::t('Delete') ?></th>
        </tr>
        <?php if ($items->goods) :?>
            <?php foreach ($items->goods as $key=> $item) : ?>
                <tr>
                    <td>
                        <a href="<?=Url::to('/?slug='.$item->item->template->slug.'&item_slug='.$item->item->slug)?>">
                            <img src="<?= $item->item->photo ?>" style="width: 150px">
                        </a>
                    </td>
                    <td>
                        <a href="<?=Url::to('/?slug='.$item->item->template->slug.'&item_slug='.$item->item->slug)?>">
                            <h5 class="product_title"><?= $item->item->title?>&nbsp;<span>(<?=$item->item->template->title?>)</span></h5>
                        </a>
                    </td>
                    <td>
                        <? if($item->item->sale): ?>
                            <span class="price-new"><?= number_format($item->item->price * (1 - $item->item->sale/100), 2, ',', ' '); ?>   &nbsp;&nbsp;&nbsp;</span>
                            <span class="price-old"> <?= number_format($item->item->price, 2, ',', ' '); ?></span>
                        <? else: ?>
                            <span class="price-new"> <?= number_format($item->item->price, 2, ',', ' '); ?></span>
                        <? endif; ?>
                    </td>
                    <td><?= number_format($item->price * (1 - $item->sale/100) * $item->count, 2, ',', ' '); ?>
                    </td>
                    <td>
                        <?php if ($item->pieces==NULL){?>
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
                    <td >
                        <input style="width: 100px"    type="number" name="quantity" data-id="<?=$item->item->id?>"
                                 min="1" class="lolo input-quantity form-control" value="<?=$item->count?>">
                    </td>
                    <td>
                        <a class="remove-item remove" href="#"      data-id="<?=$item->good_id?>" data-value="<?= $item->price  ?>" title="<?= Lang::t('Remove Item From Cart') ?>">
                            <button type="button" data-id="169" title="Remove" class="btn btn-danger delete"><i class="fa fa-times-circle"></i></button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif;?>
        <tfoot>
        <tr style="border-top:solid">
            <td colspan="3"><h4><?= Lang::t('Total Cost') ?></h4></td>
            <td id="cost" colspan="2" class="width-90 summa"><h4><b>0</b></h4></td>
            <td>
                <!--         <button class="btn btn-danger center update">--><?//=Lang::t('Update')?><!--</button>-->
                <!--         <input  id="sa" class="btn btn-danger center" type="button" value="--><?//=Lang::t('Update')?><!--">-->
            </td>
        </tr>
        </tfoot>
    </table>
</div>

 <div class="">
    <a class="btn btn-danger left" href="<?//= $this->to('catalog/books') ?>"><?= Lang::t('Continue Shopping') ?></a>
    <a class="btn btn-danger main-bg right" href="<?=Url::to(['site/complete'])?>"><?= Lang::t('Proceed to Checkout') ?></a>
</div>




<p></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function () {
        $("input.lolo").bind('change', xodisa)
    });
    function xodisa(e) {
        // alert('okk');
        e.preventDefault();

        var count = [];
           var id = [];
           $(".input-quantity").each(function(i){
               count[i] = $(this).val();
           });
           $(".input-quantity").each(function(i){
               id[i] = $(this).data("id");
           });


           $.get("/site/update",{item:id, quantity:count},function(response){

                   if(response.result=="success"){
                       $("#cost").html(response.cost);
                       console.log(response.cost);

                   } else console.log(response.result);
               });
        // console.log(data);
    }
</script>
<?php

$this->registerJs('
//    $function(){
//    alert(salom);
//        $("updatesar").click(function(e){
//            e.preventDefault();
//            
//            var count = [];
//            var id = [];
//            $(".input-quantity").each(function(i){
//                count[i] = $(this).val();
//            });
//            $(".input-quantity").each(function(i){
//                id[i] = $(this).data("id");
//            });
//            console.log(id);
//            
//            $.get("/site/update",{item:id, quantity:count},function(response){
//                
//                    if(response.result=="success"){
//                        console.log(response.result)
//                        
//                    } else console.log(response.result);
//                });
//        });
//    }
        


    $(".remove").click(function(e){
        e.preventDefault();
        var data = $(this).attr("data-id");
        // var value = $(this).attr("data-value");
        // var summa = $(".summa b").html();
        // value = Number(value);
        // summa = Number(summa);
        $.get("/site/delete",{good_id: data},function(response){
        // console.log(responce);
            if(response.result=="success") {console.log("success");
            window.location.reload();}
            else console.log(response.result);
            //$(".summa b").html(summa-value);
        });
        
    });
');

?>


