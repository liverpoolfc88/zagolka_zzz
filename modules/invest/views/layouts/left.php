<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<!--                <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->

                <img src="/web/<?=Yii::$app->user->identity->image?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <a href="<?=Yii::$app->UrlManager->createUrl('/invest/.')?>"
                <p>www.invest.uz</p>
                </a>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <a href="<?=Yii::$app->UrlManager->createUrl('/invest/user/user')?>">
        <p style="color: white" align="center"><?=Yii::$app->user->identity->fio?></p>
        </a>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Menu', 'icon' => 'file-code-o', 'url' => ['/invest/menu/index']],
                    ['label' => 'Maqolalar', 'icon' => 'file-code-o', 'url' => ['/invest/menu-item/index']],
                    ['label' => 'Tarjimalar', 'icon' => 'file-code-o', 'url' => ['/invest/text-translate/index']],
                    ['label' => 'Rasm', 'icon' => 'file-code-o', 'url' => ['/invest/photo/index']],
                    ['label' => 'Shopcart', 'icon' => 'dashboard', 'url' => ['/invest/shopcart/index']],
                    ['label' => 'User', 'icon' => 'dashboard', 'url' => ['/invest/user/index']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>

    </section>

</aside>
