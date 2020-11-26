<?php

namespace app\controllers;
use app\models\dilshod\Photo;
use app\models\Lang;
use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\ShopcartGoods;
use app\models\ShopcartOrders;
use yii\data\Pagination;
use app\models\maxpirali\Menu;
use app\models\maxpirali\MenuItem;
use app\models\maxpirali\MenuItemTrans;
use app\models\dilshod\MenuItemTransSearch as Trans;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $cookies = Yii::$app->request->cookies;
        if (($cookie = $cookies->get('language')) !== null) {
            Yii::$app->language = $cookie->value;
        }
        if (Yii::$app->user->isGuest) {
            if((Yii::$app->controller->action->id!='login') && 
            (Yii::$app->controller->action->id!='signup')){
            $model = new LoginForm();
            return $this->redirect(['login', 'model' => $model]);
        }
        }
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($slug = '', $item_slug = '')
    {
        // var_dump($item_slug); die;
        if ($slug) {
            $menu = Menu::find()->where(['slug' => $slug])->one();
            $items = MenuItem::find()->where(['menu_id'=>$menu->id])->orderBy(['id'=>SORT_DESC])->all();
            if ($item_slug) {
                $items = MenuItem::find()->where(['slug'=>$item_slug])->orderBy(['id'=>SORT_DESC])->all();
            }
            switch (count($items)) {
                case 0:
                    return $this->render('error');
                    break;

                case 1:
                    return $this->renderPage($items,$menu);
                    break;
                
                default:
                    return $this->renderPages($slug);
                    break;
            }
            return $this->render('/'.$menu->template().'/pages');
        }
        $photos = Photo::find()->where(['status'=>Photo::STATUS_ACTIVE])->all();
        return $this->render('index',[
            'photos' => $photos,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }



    // public function actionAddress()
    // {
    //     $id = ShopcartOrders::getId();
    //     $model=ShopcartOrders::find()->where(['order_id'=>$id])->one();

    //     if ($model->load(Yii::$app->request->post())) {   
    //     $model->status=1;  
    //     $model->address=$model->address." ,".$model->remark;
    //     $model->remark=NULL;

    //     if ($model->save())
    //         return $this->render('sucsess', [
    //         'model' => $model,
    //     ]);
    //     }
    //     return $this->render('address', [
    //         'model' => $model,
    //     ]);
    // }


    public function actionComplete()
    {
        $id = ShopcartOrders::getId();
        if (empty($id)) {
        return $this->goHome();
         }
        $model=ShopcartOrders::find()->where(['order_id'=>$id])->one();
        $user  = User::find()->where(['id'=>$model->auth_user])->one();

      
        $model->status=1;  
        $model->remark=$user->remark;
        $model->address=$user->address.",".$model->remark;
        $model->phone=$user->tel;
        $model->name=$user->username;
        $model->email=$user->email;
//        $model->access_token=null;
        // $model->remark=NULL;
        
        if ($model->save())
            return $this->render('sucsess', [
            'model' => $model,
        ]);
        exit(Lang::t('error'));
       
    }





    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }






     public function actionSucsess(){

        return $this->render('sucsess');
    }




    public function actionSignup()
    {
        $model = new SignupForm(); // Не забываем добавить в начало файла: use app\models\SignupForm; или заменить 'new SignupForm()' на '\app\models\SignupForm()'

        if ($model->load(Yii::$app->request->post())) { // Если есть, загружаем post данные в модель через родительский метод load класса Model
            // var_dump($model);die;
            if ($user = $model->signup()) { // Регистрация
                // if (Yii::$app->getUser()->login($user)) { // Логиним пользователя если регистрация успешна
                    return $this->actionConfirm(); // Возвращаем на главную страницу
                // }
            }
        }

        return $this->render('signup', [ // Просто рендерим вид если один из if вернул false
            'model' => $model,
        ]);
    }
    public function renderPage($item, $menu)
    {
        $item = $item[0];
        $item->views += 1;
        $item->save(false);
        return $this->render('/'.$menu->template().'/page',['model'=>$item,'menu'=>$menu]);
    }
    public function renderPages($slug)
    {
        $menu = Menu::find()->where(['slug'=>$slug])->one();
        // sardor
        $query = MenuItem::find()->where(['menu_id'=>$menu->id])->andWhere(['status'=>[MenuItem::STATUS_ACTIVE,MenuItem::STATUS_INACTIVE]]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 12 ]);
        $models = $query->offset($pages->offset)
            ->orderBy(['id'=>SORT_DESC])
            ->limit($pages->limit)
            ->all();
        // echo "<pre>";var_dump($models); die;
        return $this->render('/'.$menu->template().'/pages',[
            'model' => $models, 
            'pages' => $pages, 
            'menu' => $menu
        ]);
    }

    public function actionSale()
    {
        $item_id = $_GET['item'];
        $quantity = (isset($_GET['quantity']))?$_GET['quantity']:1;
        //var_dump($item_id); die;
        $good = ShopcartGoods::saved($item_id, $quantity);
        if ($good=="success") {
            $order = ShopcartOrders::find()->where(['access_token'=>Yii::$app->session->getId()])->one();
            Yii::$app->response->format='json';
            return ['result' => 'success','cost'=>$order->cost, 'count'=>$order->count];
        }
        else {
            Yii::$app->response->format='json';
            return ['result' => 'error'];
        }
    }
    public function actionUpdate()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $item_id = $_GET['item'];
        $quantity = ($_GET['quantity'])?$_GET['quantity']:1;
        $error = 0;
        foreach ($item_id as $key => $item){
            $good = ShopcartGoods::saved($item, $quantity[$key]);
            if ($good != "success") $error +=1;
        }
        //var_dump($error); die;
        
        if (!$error) {
            $order = ShopcartOrders::find()->where(['access_token'=>Yii::$app->session->getId()])->one();
            Yii::$app->response->format='json';
            return ['result' => 'success','cost'=>$order->cost, 'count'=>$order->count];
        }
        else {
            Yii::$app->response->format='json';
            return ['result' => 'error'];
        }
    }

    public function actionCart()
    {
        $order = ShopcartOrders::goods();
        $cost = $order->cost;
        // return $this->render('card');
        return $this->render('card', [
            'items' => $order,
//            return json_encode($_POST);
            'cost'=> json_encode($cost)
        ]);
    }
     public function actionPricelist(){

        $price = MenuItem::find()->where(['status'=>[1,0]])->all();

        return $this->render('pricelist',[
            'items'=>$price,
        ]);
    }

    public function actionHistory(){

         $model = ShopcartOrders::find()->where(['auth_user'=>Yii::$app->user->identity->id])
         ->orderBy(['order_id'=>SORT_DESC])->all();
         // echo "<pre>"; var_dump(Yii::$app->user->identity->id); die;
         return $this->render('history',[
            'history'=>$model
         ]);

        // $history = MenuItem::find()->all();

        // return $this->render('history',[
        //     'history'=>$history,
        // ]);
    }
    public function actionChegirma(){
        $model = MenuItem::find()
        ->where(['not',['sale'=>NULL]])
        ->andWhere(['not',['sale'=>'']])
        ->orderBy(['sale'=>SORT_DESC])
        ->limit(21)->all();    

        return $this->render('chegirma',[
            'model'=>$model
        ]);
    }


    public function actionNew(){
        $model = MenuItem::find()
        ->where(['new'=>1])        
        ->orderBy(['new'=>SORT_DESC])
        ->limit(21)->all();    

        return $this->render('new',[
            'model'=>$model
        ]);
    }



    public function actionDelete()
    {
        $good_id = $_GET['good_id'];
        $good = ShopcartGoods::find()->where(['good_id'=>$good_id])->one();
        $good->delete();
        Yii::$app->response->format='json';
        return ['result' => 'success'];
    }

    public function actionConfirm()
    {
        return $this->render('confirm');
    }

    public function actionSearch()
    {
        $new = Trans::find()->where(['status'=>1])
        ->andWhere(['like', 'title', Yii::$app->request->queryParams['search']])
        ->andWhere(['like', 'short', Yii::$app->request->queryParams['search']])
        ->andWhere(['like', 'text', Yii::$app->request->queryParams['search']])
        ->orderBy(["id" => SORT_DESC])
        ->all();
    // var_dump(Yii::$app->request->queryParams['search']);exit;
        // $data =$new->search(Yii::$app->request->queryParams);
        return $this->render('search', [
            'model' => $new,
        ]);
    }
    
    // public function actionLoogin()
    // {

    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->redirect(['index']);
    //     }
    //     return $this->render('loogin', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionLang(){
        $get = Yii::$app->request->get();
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => $get[1]['id'],
        ]));
        // echo "<pre>"; var_dump($vaa); die;
        if($get){
            return $this->redirect($get[1]['url']);
        }else{
          return $this->goHome();
        }
    }
}
