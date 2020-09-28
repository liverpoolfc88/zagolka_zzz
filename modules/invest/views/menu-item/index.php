<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Lang;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\dilshod\MenuItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Lang::t("Yangi maqola qo`shish"), ['create'], ['class' => 'btn btn-success']) ?>
        <!-- <a href='javascript:history.back()' class='btn btn-danger'>ortga</a> -->
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'menu_id',
            [
              'attribute' => 'menu_id',
              'filter' => false,
              // 'format' => 'raw',
               'value' => function ($model) {
                   return  $model->getMenuTitle($model->menu_id);
               },
            ],
            [
             'attribute' =>  Lang::t("Rasm"),
             'format' => 'raw',
             'value' => function ($model) {   
                if (!empty($model->photo))
                  return '<img src="/web/'.$model->photo.'" width="120px" height="auto">'; 
                else return Lang::t('Rasm yuklanmagan');
             },
            ],
            'title',
            'short',
            'text:ntext',
            //'slug',
            'views',
             //'status',
            'price',
            'sale',
            'pieces',
            [
              'attribute' => 'status',
              'filter' => false,
              // 'format' => 'raw',
               'value' => function ($model) {
                   return  $model->getStatus()[$model->status];
               },
            ], 
            //'user_id',
            //'created_date',
            //'updated_date',
            [
             'attribute' =>  Lang::t("Lang"),
             'value' => function ($model) {  
                $val =""; 
                foreach ($model->menutemplate as $key => $value) {
                    if ($value->lang=="uz-UZ") continue;
                    else {
                        if ($value->lang=="ru-RU") $val.="RU ";
                        else $val.="EN ";
                    }
                }
                return $val;
             },
            ],
            
          
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
