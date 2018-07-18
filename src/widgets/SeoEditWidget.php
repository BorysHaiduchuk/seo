<?php

namespace boryshaiduchuk\seo\widgets;

use yii\base\Widget;
use boryshaiduchuk\seo\models\Seo;

class SeoEditWidget extends Widget
{
    public $model;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('seo_edit', ['model' => $this->model]);
    }
}