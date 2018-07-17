<?php

namespace boryshaiduchuk\seo\controllers;

use boryshaiduchuk\seo\models\Seo;
use yii\web\Controller;

/**
 * Default controller for the `seo` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEditSeo($model_id, $table_name, $seo_rules_id)
    {
        $condition = [
            'model_id' => $model_id,
            'seo_rules_id' => $seo_rules_id,
            'table_name' => $table_name
        ];

        $model = Seo::findOne($condition);

        if (! $model) {
            $model = new Seo($condition);
        }

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->asJson([
                'success' => true,
                'message' => \Yii::t('app', 'Seo data saved successfully'),
            ]);
        }
    }
}
