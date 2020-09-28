<?php

namespace app\modules\invest\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `invest` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	
//        return $this->render('index');
//        $item = Project::find();
        $model = Yii::$app->user->identity;
//    	return $this->redirect('user/user');
//        var_dump($item); die();
        return $this->render('index',[
            'model'=>$model,
//            'item'=>$item

        ]);

    }

    public function actionLogin()
    {
    	return $this->render('login');
    }
}
