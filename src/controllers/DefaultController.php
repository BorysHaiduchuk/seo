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

    /**
     * Edit seо data
     * @param $model_id
     * @param $table_name
     * @param $seo_rules_id
     * @return \yii\web\Response
     */
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
            return $this->redirect(\Yii::$app->request->getReferrer());
        }
    }
}
