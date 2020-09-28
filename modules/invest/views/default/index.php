<?
use yii\widgets\DetailView;
use yii\helpers\Html;
    $this->title='Sayt sozlamalari';
    $this->registerMetaTag([
       'name'=>'description',
        'content'=>'Andijon investitsiya'
    ]);
    $this->registerMetaTag([
       'name'=>'keywords',
        'content'=>'andijon, investitsiya, invest, andijon viloyati'
    ]);

if (!Yii::$app->user->identity){

    ?>

    <div class="invest-default-index">
        <h1><?= $this->context->action->uniqueId ?></h1>
        <p>
            This is the view content for action "<?= $this->context->action->id ?>".
            The action belongs to the controller "<?= get_class($this->context) ?>"
            in the "<?= $this->context->module->id ?>" module.
        </p>
        <p>
            You may customize this page by editing the following file:<br>
            <code><?= __FILE__ ?></code>
        </p>
    </div>


<?}else{?>


    <div class="container-fluid">
       
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//             'id',
                    [
                        'attribute'=>'image',
                        'label'=>'Rasmi:',
                        'format'=>'raw',
                        'value'=>function($model){
//                        return Html::img('/web/'.$model->image.'',['style'=>'width:100px']);
                            return '<img width="100px" src="/web/'.$model->image.'">';
                        }
                    ],
                    [
                        'attribute'=>'username',
                        'label'=>'Foydalanuvchi:'
                    ],
                    'fio',
                    [
                        'attribute'=>'birthdate',
                        'value'=>function($model){
                            return date('d-m-Y', $model->birthdate);
                        }
                    ],
                    'tel',
                    'email'
                ],
            ]) ?>
        </div>
         <div class="col-md-6">
        </div>
    </div>
<?}?>