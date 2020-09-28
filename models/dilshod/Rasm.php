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
class Rasm extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE=1;
    const STATUS_INACTIVE=0;
    const STATUS_DELETE=9;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'in_rasm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['slug'], 'required'],
            [['photo_id'], 'integer'],
            // [['src'], 'string', 'max' => 255],
            [['src'],'file','maxFiles' => 10]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo_id' => Lang::t('Photo'),
            'src' => Lang::t("Path"),
            // 'info' => Lang::t("Description"),
            // 'status' => 'Status',
        ];
    }

    public function getStatus()
    {
        return [
        '1' => Lang::t('Aktiv'),
        '0' => Lang::t('Nofaol'),
    ];
    }
}
