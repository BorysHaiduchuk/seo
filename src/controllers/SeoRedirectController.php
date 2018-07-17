<?php
namespace boryshaiduchuk\seo\controllers;

use boryshaiduchuk\seo\models\SeoRedirect;
use yii\web\Controller;
use yii\base\Model;
use Yii;

class SeoRedirectController extends Controller
{
    public function actionIndex($add_new = 0)
    {
        $models = SeoRedirect::find()->all();
        for ($i = 0;  $i < $add_new; $i++) {
            $models[] = new SeoRedirect();
        }
        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            foreach ($models as $item) {
                $item->save(false);
            }
            Yii::$app->session->setFlash('success', 'Changes saved.');
            return $this->redirect(['index']);
        }

        return $this->render('index', ['models' => $models, 'add_new' => $add_new]);
    }

    public function actionDelete($id)
    {
        $model = SeoRedirect::findOne($id);

        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Item deleted.');
            return $this->redirect(['index']);
        }
    }
}