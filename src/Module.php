<?php

namespace boryshaiduchuk\seo;


/**
 * seo module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'boryshaiduchuk\seo\controllers';

    /**
     * Aplication lang_id
     * @var int
     */
    public $lang_id;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
