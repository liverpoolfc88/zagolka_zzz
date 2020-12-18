<?


use app\models\ShopcartOrders;
use app\models\Lang;
use yii\helpers\Url;

$this->title = Lang::t('Shopping cart');

// echo "<pre>"; var_dump($items->goods[0]->item->template->id); die;
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<section>
    <div class="row">
        <?php if ($items->goods) : ?>
            <?php foreach ($items->goods as $key => $item) : ?>
                <div id="<?=$item->good_id?>" class="  col-md-6">
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
                                    <button data-id="<?=$item->good_id?>" class="lolo remove"
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
                                                    <?= $item->item->price * (1 - $item->item->sale / 100) ?> <?= '<span style="text-decoration: line-through;">' . $item->item->price . '</span>' ?>
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
                let price = $('b.' + title).html();
                price = parseInt(price);
                var sum = price * (a - 1);
                $("b.sum" + title).html(sum);
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
            var sum = price * (a + 1);
            console.log(sum);
            $("b.sum" + title).html(sum);
        });
    });

    $(function () {
        $("button.remove").bind('click', remove)
    })

    function remove(e){
        e.preventDefault();
        let data = $(this).attr('data-id');
        $.get("/site/delete", {good_id: data}, function (response) {
            console.log(response);
            if (response.result == "success") {
                console.log("o`chib ketdi");
                $("div#" + data).remove();

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

            }
            else console.log(response.result);
        });



    }


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
