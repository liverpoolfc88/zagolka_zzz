<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\maxpirali\Menu;
use app\models\Lang;
use app\models\ShopcartOrders;

$goods = ShopcartOrders::goods();
$this->registerJs("
setInterval(setDateTime,1);
    function setDateTime(){
        var D = new Date();
        var h = D.getHours();
        var i = D.getMinutes();
        var s = D.getSeconds();
        if(h<10){
            h = '0'+h;
        }if(i<10){
            i = '0'+i;
        }if(s<10){
            s = '0'+s;
        }
        document.getElementById('cur-time').innerHTML = h+':'+ i +':'+s;
    }
    ");
?>


<nav id="top ">
    <div itemscope itemtype="<?=Lang::t('Site_Url')?>">
        <meta itemprop="name" content = "<?=Lang::t('Organization name')?>"/>
        <meta itemprop="telephone" content="<?=Lang::t('phone number')?>"/>
        <meta itemprop="fax" content="<?=Lang::t('fax number')?>"/>
        <div itemprop="address" itemscope itemtype="<?=Lang::t('Site_Url')?>">
            <meta itemprop="streetAddress" content="<?=Lang::t('streetAddress')?>"/>
        </div>
        <meta itemprop="email" content="<?=Lang::t('email')?>"/>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo-container">
                <div class="logo">
                    <a href="<?=Url::to('/')?>">
                        <img src="img/logo.png" alt="<?=Lang::t('Organization name')?>"/>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?=Lang::t('menu')?></button>

                    <ul class="dropdown-menu">
                        <?php PrintMenu(Menu::menus()); ?>
                        <? if (Yii::$app->user->isGuest): ?>
                        <li class="divider"></li>
                        <li><a class="signup" href="<?=Url::to(['site/signup'])?>"><?=Lang::t('signup')?></a></li>
                        <li class="divider"></li>
                        <li><a class="signup" href="<?=Url::to(['site/login'])?>"><?=Lang::t('login')?></a></li>
                        <? else: ?>
                        <li class="divider"></li>
                        <li><?= Html::a(Lang::t('Logout'), ['site/logout'], ['data' => ['method' => 'post']]) ?></li>
                        <? endif; ?>
                        <li class="divider"></li>
                        <li class="dropphone"><?=Lang::t('phone number')?></li>
                        <li class="dropphone"><a href="mailto:<?=Lang::t('email')?>" title="<?=Lang::t('Send text to email')?>"><?=Lang::t('email')?></a></li>
                        <li class="divider"></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="header-row-1  hidden-xs visible-sm visible-md visible-lg">
                    <div class="prikh_header">
                        <div class="prikh_header__text">
                            <p><?=Lang::t('Organization name')?></p>

                            <i> <span style="color: #e40981" class="topbar-date"><span id='cur-time'></span>&emsp;</span><span style="color: #e40981" ><?= date('d. m. Y H:i:s') ?></span></i>

                        </div>
                        <div class="prikh_header__contacts">
                            <span class="mail-sp"><a href="mailto:<?=Lang::t('email')?>" title="<?=Lang::t('Send text to email')?>"><?=Lang::t('email')?></a></span>
                            <span class="phone-sp"><span class="ya-phone"><?=Lang::t('phone number')?></span></span>
                        </div>
                        <div class="prikh_header__right">
                            <div class="prikh_btns" style="width: 150px">
                                <? if(Yii::$app->user->isGuest): ?>
                                <a class="signup" href="<?=Url::to(['login'])?>"><?=Lang::t('login')?></a>
                                <span> | </span>
                                <a class="signup" href="<?=Url::to(['site/signup'])?>"><?=Lang::t('signup')?></a>
                                <? else: ?>
                                    <p class="phone-sp"><?=Yii::$app->user->identity->username?></p><br>
                                    <?= Html::a(Lang::t('Logout'), ['site/logout'], ['data' => ['method' => 'post']]) ?>
                                <? endif; ?>

                            </div>
                            <div class="prikh_btns" style="display: inherit;">

                                <?= Html::a(Lang::t('Uz'), ['site/lang',['id'=>'uz-UZ', 'url'=>Url::current()]]) ?>
                                <span> | </span>
                                <?= Html::a(Lang::t('Ru'), ['site/lang',['id'=>'ru-RU', 'url'=>Url::current()]]) ?>
                                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-row-2 hidden-xs visible-sm visible-md visible-lg">
                    <ul class="links">
                        <li><a href="<?=Url::to('site/about')?>" class=""><?=Lang::t('About Us')?></a></li>
                         <li><a href="<?=Url::to('site/chegirma')?>" class=""><?=Lang::t('Sale')?></a></li>
                           <li><a href="<?=Url::to('site/new')?>" class=""><?=Lang::t('new')?></a></li>
                        <li><a href="<?=Url::to('site/pricelist')?>" class=""><?=Lang::t('Price list')?></a></li>
                         <li><a href="<?=Url::to('site/history')?>" class=""><?=Lang::t('History')?></a></li>
                        <li><a href="<?=Url::to('site/contact')?>" class=""><?=Lang::t('Contacts')?></a></li>
                    </ul>
                </div>
                <div class="header-row-3">
                    <div class="col-xs-12 col-sm-8 nopads">
                        <div id="search">
                            <div class="inner">
                                <form action="site/search">
                                    <button type="button" class="" id="button-search"><i class="fa fa-search"></i></button>
                                    <input type="text" name="search" value="" placeholder="<?=Lang::t('search')?>" id="search-field"/>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="cart">
                            
                            <a class="cart-link" href="<?=Url::to('site/cart')?>">
                                <span class="cart-title"><?=Lang::t('Basket')?>:</span>
                                <span id="cart-total"><b class="soni"><?=($goods->count)?$goods->count:0?></b> <?=Lang::t('products worth')?> <b class="narxi"><?=($goods->cost)?$goods->cost:0?></b> so`m</span>
                                <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <p class="text-center"><?=Lang::t('your basket is empty')?>!</p>
                                    </li>
                                </ul>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<?php function PrintMenu($menu){ ?>
    <? foreach ($menu as $value) { ?>
        <li><a href="<?=Url::to(['site/index', 'slug' => $value['slug']])?>"><?=$value['title']?></a>
            <?// if ($value['children']) { ?>
                <!-- <ul> -->
                    <? //PrintMenu($value['children']); ?>
                <!-- </ul> -->
            <?//} ?>
        </li>
        <? } ?>  
   <? }?>

