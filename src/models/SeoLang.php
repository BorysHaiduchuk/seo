<?php

namespace boryshaiduchuk\seo\models;

use Yii;


/**
 * This is the model class for table "seo_lang".
 *
 * @property int $lang_id
 * @property int $record_id
 * @property string $h1
 * @property string $title
 * @property string $description
 * @property string $og_title
 * @property string $og_description
 *
 * @property Seo $record
 */
class SeoLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang_id'], 'required'],
            [['lang_id', 'record_id'], 'integer'],
            [['h1', 'title', 'og_title'], 'string', 'max' => 300],
            [['description', 'og_description'], 'string', 'max' => 400],
            [[ 'keywords'], 'string'],
            [['lang_id', 'record_id'], 'unique', 'targetAttribute' => ['lang_id', 'record_id']],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seo::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => Yii::t('seo', 'Lang ID'),
            'record_id' => Yii::t('seo', 'Record ID'),
            'h1' => Yii::t('seo', 'H1'),
            'keywords' => Yii::t('seo', 'Keywords'),
            'title' => Yii::t('seo', 'Title'),
            'description' => Yii::t('seo', 'Description'),
            'og_title' => Yii::t('seo', 'Og Title'),
            'og_description' => Yii::t('seo', 'Og Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(Seo::className(), ['id' => 'record_id']);
    }
}
