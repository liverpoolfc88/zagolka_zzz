<?
use app\models\Lang;
use app\models\maxpirali\Menu;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<style type="text/css">
    footer {
        background:  #545455;

    }
    .pad{
        padding-top: 20px
    }
     .p{
        color: white;
    }
    .foot{
        background-color: #545455;
        height: 100%
    }
    ul li a i.bold {
    width: 25px;
    height: 25px;
    background-color: #636363;
    color: #fff;
    border-radius: 3px;
    text-align: center;
    line-height: 25px;
    margin-right: 10px
    }
    li{
        padding-bottom: 10px
    }
    div .like{
        margin: 20px
    }
    .mar{
        margin: 10px
    }
    div ul {
        font-size: 15px;
        padding: 0;
    }
    li  .white{
        color: white
    }

</style>
<footer>
    <div class="container pad">
         <section>
            <img style="background: white; height: 50px" src="/img/logo.png">
        </section>
         <div class="row">
            <div class="col-md-4">
                   <ul >
                        <li ><a class="white" href="<?=Url::to('/')?>"><span ><i class="mar fa fa-home"></i></span>Bosh sahifa</a></li><li ><a class="white" href="<?=Url::to('site/about')?>"><span ><i class="mar fa fa-home"></i></span>Biz haqimizda</a></li>
                        <li><a class="white" href="<?=Url::to('site/pricelist')?>"><span ><i class="mar fa fa-check-square"></i></span>Narxlar ro'yxati</a></li>
                        <li><a class="white" href="<?=Url::to('site/contact')?>"><span ><i class="mar fa fa-file"></i></span>Contact</a></li>
                    </ul>
            </div>
                <div class="col-md-4">
                    <ul>
                        <?php PrintMenuFoot(Menu::menus()); ?>
                    </ul>              
                </div>
             <div class="col-md-4">
                    <ul >
                        <li > <a class="white" href="#"><span><i class="mar fa fa-map-marker"></i></span>Farģona, Qòqon shahar Navbaxor 26-uy</a></li>
                        <li> <a class="white" href="#"><span ><i class="mar fa fa-envelope"></i></span>amina-taqinchoq@mail.ru</a></li>
                        <li> <a class="white" href="#"><span ><i class="mar fa fa-phone"></i></span>+998 93 3826003</a></li>
                        <li> <a class="white" href="#"><span ><i class="mar fa fa-send bold"></i></span>@Sh_M_Aripov</a></li>
                    </ul>  
            </div>
        </div>
        </div>
        
        
    <div style="text-align: center; padding:10px;  background-color: black; " class="container-fluid" >
      <div style="color: white" >
        &copy; Copyright <strong>websar.uz</strong> Barcha huquqlar himoyalangan.<strong>2019 Y.</strong>
      </div>
      <div class="credits">
      <h5 style="color: white"> Manbaa: <a  href="https://www.websar.uz/" target="_blank">www.websar.uz</a></h5>
      </div>
    </div>
        
   
    
</footer>


<?php  function PrintMenuFoot($menu){ ?>
    <? $i=0; foreach ($menu as $value) {
        $i++; 
        if ($i==5) break;
        // var_dump($key2); die;
        ?>

        <li ><a  href="<?=Url::to(['site/index', 'slug' => $value['slug']])?>" class="white parent-a"><i class="mar fa fa-play"></i><?=$value['title']?></a>
            <? if ($value['child']) { ?>
               
            <?} ?>
        </li>
        <? }  
    }

    
?>
<?php
$this->registerJs('
    $(".cart-button-krl").click(function(e){
        // e.preventDefault();
        var items = $(this).attr("data-id");
        // console.log(items);
        $.get("/site/sale",{item: items},function(response){
            
                if(response.result=="success"){
                    $("b.soni").text(response.count);
                    $("b.narxi").text(response.cost);
                    //   window.location.reload();
                } else console.log(response.result);
            });
    });
    

    
');

?>
<script>
window.replainSettings = { id: '748b97a8-7f4c-4c63-9cde-419c67679a8b' };
(function(u){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src=u;
var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
})('https://widget.replain.cc/dist/client.js');
</script>