<?php

namespace boryshaiduchuk\seo\models;

use Yii;

/**
 * This is the model class for table "seo_redirect".
 *
 * @property int $id
 * @property string $from_url
 * @property string $to_url
 */
class SeoRedirect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo_redirect';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_url', 'to_url'], 'required'],
            [['from_url', 'to_url'], 'string', 'max' => 500],
            ['from_url', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('seo', 'ID'),
            'from_url' => Yii::t('seo', 'From Url'),
            'to_url' => Yii::t('seo', 'To Url'),
        ];
    }
}
