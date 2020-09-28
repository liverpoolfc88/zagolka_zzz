<?php

namespace app\models\dilshod;

use Yii;
use app\models\Lang;

/**
 * This is the model class for table "in_photo".
 *
 * @property int $id
 * @property string $slug
 * @property string $image
 * @property int $status
 */
class Photo extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE=1;
    const STATUS_INACTIVE=0;
    const STATUS_DELETE=9;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'in_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['slug'], 'required'],
            [['status'], 'integer'],
            [['slug','info'], 'string', 'max' => 255],
            [['image'],'file','maxFiles' => 10]
        ];
    }

    public function beforeSave($insert){
        if($insert){
//            $this->child = 0;
            $this->status = self::STATUS_ACTIVE;
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => Lang::t('Slug'),
            'image' => Lang::t("Image"),
            'info' => Lang::t("Description"),
            'status' => 'Status',
        ];
    }

    public function getStatus()
    {
        return [
        '1' => Lang::t('Aktiv'),
        '0' => Lang::t('Nofaol'),
    ];
    }
    public static function getPhoto(){
        return self::find()->where(['status'=>self::STATUS_ACTIVE])->all();
    }
    public function getRasm(){
        return $this->hasMany(\app\models\dilshod\Rasm::className(), ['photo_id' => 'id'])->all();
    }
}
