<?php

namespace boryshaiduchuk\seo\models;

use boryshaiduchuk\langbehavior\LangBehavior;
use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string $table_name
 * @property int $seo_rules_id
 * @property int $record_id
 * @property string $og_image
 * @property string $redirect_301
 * @property string $meta_index
 *
 * @property SeoRules $seoRules
 * @property SeoLang[] $seoLangs
 * @property Lang[] $langs
 */
class Seo extends \yii\db\ActiveRecord
{

    public $title;
    public $description;
    public $h1;
    public $keywords;
    public $og_title;
    public $og_description;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seo_rules_id', 'model_id', 're_generate'], 'integer'],
            [['table_name'], 'string', 'max' => 255],
            [['og_image'], 'string', 'max' => 350],
            [['redirect_301', 'meta_index'], 'string', 'max' => 300],
            [['seo_rules_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoRules::className(), 'targetAttribute' => ['seo_rules_id' => 'id']],
            [['h1', 'title', 'og_title'], 'string', 'max' => 300],
            [['description', 'og_description'], 'string', 'max' => 400],
            [['keywords'], 'string'],

        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => LangBehavior::className(),
                't' => new SeoLang(),
                'fk' => 'record_id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'table_name' => Yii::t('app', 'Table Name'),
            'seo_rules_id' => Yii::t('app', 'Seo Rules ID'),
            'model_id' => Yii::t('app', 'Record ID'),
            'og_image' => Yii::t('app', 'Og Image'),
            'redirect_301' => Yii::t('app', 'Redirect 301'),
            'meta_index' => Yii::t('app', 'Meta Index'),
            're_generate' => Yii::t('app', 'Re generate after update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasOne(SeoRules::className(), ['id' => 'seo_rules_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoLangs()
    {
        return $this->hasMany(SeoLang::className(), ['record_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Lang::className(), ['id' => 'lang_id'])->viaTable('seo_lang', ['record_id' => 'id']);
    }
}
