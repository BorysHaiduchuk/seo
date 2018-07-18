<?php
namespace boryshaiduchuk\seo\controllers;

use boryshaiduchuk\seo\models\SeoRedirect;
use yii\web\Controller;
use yii\base\Model;
use Yii;

class SeoRedirectController extends Controller
{
    /**
     * List of all redirects with the ability to edit.
     * @param int $add_new
     * @return string|\yii\web\Response
     */
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
            Yii::$app->session->setFlash('success', Yii::t('seo', 'Changes saved.'));
            return $this->redirect(['index']);
        }

        return $this->render('index', ['models' => $models, 'add_new' => $add_new]);
    }

    /**
     * Deletes an existing SeoRedirect model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = SeoRedirect::findOne($id);

        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', Yii::t('seo', 'Item deleted.'));
            return $this->redirect(['index']);
        }
    }
}