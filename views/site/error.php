        <?php
        use app\models\Lang;
        $this->title = Lang::t('error');
        ?>
         <ul class="breadcrumb"  >
                        <li >
          <a >
            <span itemprop="name">
              <i class="fa fa-home"></i>   
                       </span>
          </a>
          
        </li>
                              <li itemprop="itemListElement" itemscope="" itemtype="">
         
            <span itemprop="name">
              <?=Lang::t('error')?>
          </span>
         
        </li>
            </ul>
           <h1> <?=Lang::t('error')?></h1>
           <img style="width: 100%; margin-bottom: 30px; margin-top: 30px" src="/img/404.png">
      <p><?=Lang::t('not-found')?></p>
      <div class="buttons">
        <!-- <div class="pull-right"><a href="" class="btn btn-primary">Продолжить</a></div> -->
      </div>
