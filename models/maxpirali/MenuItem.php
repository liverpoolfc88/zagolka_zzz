<?php

namespace app\models\maxpirali;

use Yii;
use app\models\maxpirali\MenuItemTrans;


/**
 * This is the model class for table "in_menu_item".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $title
 * @property string $photo
 * @property string $short
 * @property string $text
 * @property string $slug
 * @property integer $views
 * @property integer $status
 * @property integer $price
 * @property integer $sale
  * @property integer $pieces
 * @property integer $user_id
 * @property integer $created_date
 * @property integer $updated_date
 */
class MenuItem extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE=1;
    const STATUS_INACTIVE=0;
    const STATUS_DELETE=9;
    const NEW_ACTIVE=1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_menu_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'title', 'text', 'slug', 'views', 'status', 'user_id', 'created_date'], 'required'],
            [['menu_id', 'views', 'status','new', 'price', 'sale', 'pieces', 'user_id', 'created_date', 'updated_date'], 'integer'],
            [['text'], 'string'],
            [['title', 'photo', 'slug'], 'string', 'max' => 128],
            [['short'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu ID',
            'title' => 'Title',
            'photo' => 'Photo',
            'short' => 'Short',
            'text' => 'Text',
            'slug' => 'Slug',
            'views' => 'Views',
            'status' => 'Status',
            'new' => 'New',
            'price' => 'Price',
            'sale' => 'Sale',
            'pieces' => 'Pieces',
            'user_id' => 'User ID',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public function afterFind(){
        $result = MenuItemTrans::find()->where(['item_id'=>$this->id, 'lang'=>Yii::$app->language])->asArray()->one();
        $this->load($result,'');
        parent::afterFind();
    }

    public static function find()
    {
        return parent::find()->where(['<>', 'status', 0]);
    }

    public function getTemplate()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    public function getMenutemplate()
    {
        return $this->hasMany(MenuItemTrans::className(), ['item_id' => 'id']);
    }

    public function getTranslate()
    {
        $trans = $this->hasOne(MenuItemTrans::className(), ['item_id' => 'id'])->where(['lang'=>Yii::$app->language]);
        if (!empty($trans)) return $trans;
        return $this->hasOne(MenuItemTrans::className(), ['item_id' => 'id'])->where(['lang'=>"uz-UZ"]);
    }

    public static function getXit($menu_id)
    {
        return self::find()->where(['menu_id'=>$menu_id])
        ->andWhere(['status'=>[self::STATUS_ACTIVE,self::STATUS_INACTIVE]])
        ->orderBy(['views'=>SORT_DESC])
        ->limit(3)->all();
    }
}
