<?php

namespace app\modules\invest;

use Yii;
use yii\helpers\Url;
/**
 * invest module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\invest\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (Yii::$app->user->identity->username!="admin") {
           return Yii::$app->getResponse()->redirect(Url::to(['/']), 302);
        }
        if(Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect(Url::to(['/site/login']), 302);
        }

        // custom initialization code goes here
    }
}
