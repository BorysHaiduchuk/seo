<?php

namespace boryshaiduchuk\seo\models;

use common\behaviors\LangBehavior;
use Yii;
use common\models\Lang;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "seo_rules".
 *
 * @property int $id
 * @property string $name
 * @property string $model_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $hint
 * @property array $additional_data
 *
 * @property Seo[] $seos
 * @property SeoRulesLang[] $seoRulesLangs
 * @property Lang[] $langs
 */
class SeoRules extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_DELETE = 2;

    public $title_template;
    public $description_template;
    public $keywords_template;
    public $h1_template;
    public $og_title_template;
    public $og_description_template;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_rules';
    }

    public function behaviors()
    {
        return [
            [
                'class' => LangBehavior::className(),
                't' => new SeoRulesLang(),
                'fk' => 'record_id',
            ],
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 're_generate'], 'integer'],
            [['additional_data'], 'string'],
            [['name'], 'string', 'max' => 300],
            [['model_name'], 'string', 'max' => 255],
            [['hint'], 'string', 'max' => 400],
            [['title_template', 'og_title_template', 'og_description_template'], 'string', 'max' => 300],
            [['description_template', 'keywords_template', 'h1_template'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'model_name' => Yii::t('app', 'Model Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'hint' => Yii::t('app', 'Hint'),
            're_generate' => Yii::t('app', 'Re generate after update'),
            'additional_data' => Yii::t('app', 'Additional Data'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeos()
    {
        return $this->hasMany(Seo::className(), ['seo_rules_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoRulesLangs()
    {
        return $this->hasMany(SeoRulesLang::className(), ['record_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Lang::className(), ['id' => 'lang_id'])->viaTable('seo_rules_lang', ['record_id' => 'id']);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_NOT_ACTIVE => Yii::t('app', 'Not active'),
        ];
    }

    public function getStatusDetail()
    {
        return isset(static::getStatusList()[$this->status]) ? static::getStatusList()[$this->status] : '';
    }

    static public function getRulesAll($map = false, $limit = null)
    {
        $query = self::find()->where(['status' => self::STATUS_ACTIVE]);

        if ($limit) {
            $query->limit($limit);
        }

        $models = $query->all();
        if ($map) {
            return ArrayHelper::map($models, 'id', 'name');
        }
        return $models;
    }
}
