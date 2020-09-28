<?php
use app\models\Lang;
use yii\helpers\Url;

$this->title = "AMINA taqinchoqlari";
?>
<!-- <div class="tn-atom" field="tn_text_1549771840729">Поздравляю!<br><span style="color: rgb(22, 89, 186);">Вы успешно зарегистрировались.</span></div>
 -->
<div class="row">
<section id="about">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; color: rgb(22, 89, 186);">AMINA taqinchoqlari</h2>
            </div>

            <div class="row">
                <div class="col-sm-4 wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                  <img class="img-responsive" src="img/logo.png">
                </div>

                <div class="col-sm-5 wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
                    <h3 class="column-title"></h3>
                    <p style="text-align: justify;"><div class="tn-atom" field="tn_text_1549771840729">Поздравляю!<br><span style="color: rgb(22, 89, 186);">Вы успешно зарегистрировались.</span></div></p>
                    <p>Bog`lanish uchun quyidagi nomerga tel qiling: <a href="tel:+998933826003">+998933826003</a></p>
                    <p><a class="signup" href="<?=Url::to('site/index')?>"><?=Lang::t("Bosh sahifa")?></a></p>
                </div>
            </div>
        </div>
    </section>
</div>    