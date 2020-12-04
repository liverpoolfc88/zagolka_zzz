<?


use app\models\ShopcartOrders;
use app\models\Lang;
use yii\helpers\Url;

$this->title = Lang::t('Shopping cart');

// echo "<pre>"; var_dump($items->goods[0]->item->template->id); die;
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }

</style>
<!--cardiki-->
<style>
    .cards {
        border: black solid 1px;
        height: 200px;
        margin: 10px 0
    }

    .cards:hover {
        box-shadow: 4px 4px 4px 4px rgba(0, 0, 0, 0.2);
    }

    .cardimage {
        height: 100%;
        width: 50%;
    }

    . + {
        color: red;
    }
</style>
<section>
    <div class="row">
        <?php if ($items->goods) : ?>
            <?php foreach ($items->goods as $key => $item) : ?>
                <div id="<?= $item->good_id ?>" class="  col-md-6">
                    <div style="padding: 10px 0" class="w3-container">
                        <div class="w3-card-4" style="width:100%; padding: 10px 0">
                            <div class="w3-container">
                                <p>
                                    <?= $item->item->title . ' ( ' . $item->item->template->title . ' )' ?> |
                                    <?php
                                    if ($item->pieces == NULL) {
                                        ?>
                                        <b>
                                            <?= Lang::t('dona') ?>
                                        </b>
                                    <? } else { ?>
                                        <b>
                                            <?= Lang::t('pachkada') ?>
                                        </b>
                                        <?= $item->pieces ?>
                                        <?= Lang::t('  ta bor') ?>
                                    <? } ?>
                                    <button data-id="<?= $item->good_id ?>" class="lolo remove"
                                            style="position: absolute; right: 30px; color: red" type="">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?= $item->item->photo ?>" alt="Avatar"
                                             class="w3-left w3-circle w3-margin-right"
                                             style=" height: 60px">
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <button title="<?= $key ?>" class="minus lolo">--</button>
                                            <input data-id="<?= $item->item->id ?>"
                                                   class="input input-quantity  <?= $key ?>" style="width: 40%"
                                                   value="<?= $item->count ?>">
                                            <button title="<?= $key ?>" class="plyus lolo">+</button>
                                        </p>
                                        <p>
                                            <?= Lang::t('Price') ?> :
                                            <b class="<?= $key ?>">
                                                <? if ($item->item->sale): ?>
                                                    <?= $item->item->price * (1 - $item->item->sale / 100) ?>
                                                <? else: ?>
                                                    <?= $item->item->price ?>
                                                <? endif; ?>
                                            </b>

                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div style="padding: 16px">
                                        </div>
                                        <p class="<?= $key ?>">
                                            <?= Lang::t('Summ') ?> :
                                            <b class="sum<?= $key ?>">
                                                <?= $item->price * (1 - $item->item->sale / 100) * $item->count ?>
                                            </b>
                                        </p>
                                        <h1 class="<?= $key ?>" style="display: none"><?= $item->item->sale ?>></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="col-md-12">
            <div style="padding: 10px 0" class="w3-container">
                <div class="w3-card-4" style="width:100%; padding: 10px 0">
                    <div class="w3-container">
                        <p><?= Lang::t('Total Cost') ?> (<span id="cost"></span>) sum</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<hr>

<div class="">
    <a class="btn btn-danger left" href="<? //= $this->to('catalog/books') ?>"><?= Lang::t('Continue Shopping') ?></a>
    <a class="btn btn-danger main-bg right"
       href="<?= Url::to(['site/complete']) ?>"><?= Lang::t('Proceed to Checkout') ?></a>
</div>


<p></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

</script>
<script>

    $(function () {
        $("button.minus").click(function (e) {
            e.preventDefault();
            let title = $(this).attr("title");
            let a = $("input." + title).val();
            a = parseInt(a);
            if (a > 1) {
                $("input." + title).val(a - 1);
            }
        });
        $("button.plyus").click(function (e) {
            e.preventDefault();
            let title = $(this).attr("title");
            let a = $("input." + title).val();
            a = parseInt(a);
            $("input." + title).val(a + 1);

            let price = $('b.' + title).html();
            price = parseInt(price);

            // let salec = $('h1.'+title).html();
            // salec = parseInt(salec);


            var sum = price * (a + 1);
            console.log(sum);

            $("b.sum" + title).html(sum);
        });
        // $("button.remove").click(function (e) {
        //     e.preventDefault();
        //     $.get("/site/delete",{good_id: data},function(response){
        //
        //     });
        // })
    })


    $(function () {
        var count = [];
        var id = [];
        $(".input-quantity").each(function (i) {
            count[i] = $(this).val();
        });
        $(".input-quantity").each(function (i) {
            id[i] = $(this).data("id");
        });


        $.get("/site/update", {item: id, quantity: count}, function (response) {
            if (response.result == "success") {
                $("#cost").html(response.cost);
                console.log(response.cost);

            } else console.log(response.result);
        });

        $("button.lolo").bind('click', xodisa)
    });

    function xodisa(e) {
        // alert('okk');
        e.preventDefault();

        var count = [];
        var id = [];
        $(".input-quantity").each(function (i) {
            count[i] = $(this).val();
        });
        $(".input-quantity").each(function (i) {
            id[i] = $(this).data("id");
        });


        $.get("/site/update", {item: id, quantity: count}, function (response) {
            if (response.result == "success") {
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
        


    $("button.remove").click(function(e){
        e.preventDefault();
        var data = $(this).attr("data-id");
        var id = $(this).attr("data-id");
        $.get("/site/delete",{good_id: data},function(response){
        // console.log(responce);
            if(response.result=="success") {
            console.log("success");
            
            console.log(id);
//             window.location.reload();
            $("#"+id).remove();
            }
            else console.log(response.result);
            //$(".summa b").html(summa-value);
        });
        
    });
');

?>
