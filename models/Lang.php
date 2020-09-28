<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "in_text_translate".
 *
 * @property integer $id
 * @property string $lang
 * @property string $slug
 * @property string $text
 * @property integer $status
 * @property integer $updated_date
 */
class Lang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_text_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang', 'text'], 'required'],
            [['status', 'updated_date'], 'integer'],
            [['lang', 'slug', 'text'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lang' => 'Lang',
            'slug' => 'Slug',
            'text' => 'Text',
            'status' => 'Status',
            'updated_date' => 'Updated Date',
        ];
    }

    public static function t($message)
    {
        $matn = self::find()->where(['lang'=>self::getCurrentLang(), 'status'=>1, 'slug'=>$message])->asArray()->one();
        if(!empty($matn)) return $matn['text'];
        else {
            $matn = self::find()->where(['lang'=>'uz-UZ', 'status'=>1, 'slug'=>$message])->asArray()->one();
            if (!empty($matn)) {
                return $matn['text'];
            }else{
                return $message;
            }
        }
    }

    public static function getCurrentLang()
    {
//        Yii::$app->language="uz-UZ";
        return Yii::$app->language;
    }
}
