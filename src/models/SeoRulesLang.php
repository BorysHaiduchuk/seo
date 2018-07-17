<?php

namespace boryshaiduchuk\seo\models;

use Yii;
use common\models\Lang;

/**
 * This is the model class for table "seo_rules_lang".
 *
 * @property int $lang_id
 * @property int $record_id
 * @property string $title_template
 * @property string $description_template
 * @property string $h1_template
 * @property string $og_title_template
 * @property string $og_description_template
 *
 * @property Lang $lang
 * @property SeoRules $record
 */
class SeoRulesLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_rules_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang_id'], 'required'],
            [['lang_id', 'record_id'], 'integer'],
            [['title_template', 'og_title_template', 'og_description_template', ], 'string', 'max' => 300],
            [['description_template', 'h1_template', 'keywords_template'], 'string', 'max' => 400],
            [['lang_id', 'record_id'], 'unique', 'targetAttribute' => ['lang_id', 'record_id']],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lang::className(), 'targetAttribute' => ['lang_id' => 'id']],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoRules::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => Yii::t('app', 'Lang ID'),
            'record_id' => Yii::t('app', 'Record ID'),
            'title_template' => Yii::t('app', 'Title Template'),
            'description_template' => Yii::t('app', 'Description Template'),
            'h1_template' => Yii::t('app', 'H1 Template'),
            'og_title_template' => Yii::t('app', 'Og Title Template'),
            'og_description_template' => Yii::t('app', 'Og Description Template'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Lang::className(), ['id' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(SeoRules::className(), ['id' => 'record_id']);
    }
}
