<?php

namespace boryshaiduchuk\seo\behaviors;

use boryshaiduchuk\seo\models\Seo;
use boryshaiduchuk\seo\models\SeoRules;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class SeoBehavior extends Behavior
{
    public $seo_rules_id;
    public $rules;
    public $variables = [];
    protected $replaceColumns = ['title', 'h1', 'description', 'og_title', 'og_description', 'keywords'];

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'generate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'generate',
        ];
    }

    public function generate()
    {
        $rules = SeoRules::findOne(['id' => $this->seo_rules_id, 'status' => SeoRules::STATUS_ACTIVE]);
        $seoModel = $this->getSeoModel();
        if ($seoModel->isNewRecord) {
            $seoModel->re_generate = $rules->re_generate;
        }
        if ($seoModel->re_generate) {
            $this->replaceColumns($seoModel, $rules);
            $seoModel->save();
        }
    }

    protected function replaceColumns($seoModel, $rules)
    {
        foreach ($this->replaceColumns as $key => $value) {
            $seoModel->$value = $this->replaceKeys($value . '_template', $rules);
        }
    }

    protected function replaceKeys($template, $rules)
    {
        $attributeValue = $rules->$template;
        foreach ($this->variables as $key => $value) {
            $attributeValue = strtr($attributeValue, [
                '{' . $value . '}' => $this->owner->$value,
            ]);
        }
        return $attributeValue;
    }

    public function getSeoModel()
    {
        $condition = [
            'model_id' => $this->owner->primaryKey,
            'seo_rules_id' => $this->seo_rules_id,
            'table_name' => $this->owner::tableName()
        ];
        $model = Seo::findOne($condition);
        if (!$model) {
            $model = new Seo($condition);
        }
        return $model;
    }

    public function setSeoData()
    {
        $seo = $this->getSeoModel();
        $view = \Yii::$app->view;

        if (! $seo) {
            return $seo;
        }

        if (!empty($seo->title)) {
            $view->title = $seo->title;
        }

        if (!empty($seo->description)) {
            $view->registerMetaTag(['name' => 'description', 'content' => $seo->description]);
        }

        if (!empty($seo->keywords)) {
            $view->registerMetaTag(['name' => 'keywords', 'content' => $seo->keywords]);
        }

        if (!empty($seo->h1)) {
            $view->params['h1'] = $seo->h1;
        }

        if (!empty($seo->og_title)) {
            $view->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
            $view->registerMetaTag(['property' => 'og:title', 'content' => $seo->og_title]);
        }

        if (!empty($seo->og_description)) {
            $view->registerMetaTag(['property' => 'og:description', 'content' => $seo->og_description]);
        }

        if (!empty($seo->og_image)) {
            $image = @getimagesize(\Yii::getAlias('@webroot/' . $seo->og_image));
            $view->registerMetaTag(['property' => 'og:image', 'content' => Url::to($seo->og_image, true)]);
            if ($image) {
                $width = isset($image[0]) ? $image[0] : 0;
                $height = isset($image[1]) ? $image[1] : 0;
                $view->registerMetaTag(['property' => 'og:image:width', 'content' => $width]);
                $view->registerMetaTag(['property' => 'og:image:height', 'content' => $height]);
            }
        }

    }
}