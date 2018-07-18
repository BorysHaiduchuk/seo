<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\core\models\Setting as ModelData;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel boryshaiduchuk\seo\models\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('seo', 'Redirect');
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'Seo module'), 'url' => ['/seo']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="seo-redirect-index">
    <?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin() ?>
    <div class="col-md-8">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th><?= Yii::t('seo', 'From url') ?></th>
                <th><?= Yii::t('seo', 'To url') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $key => $value): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $form->field($value, "[$key]from_url")->label(false) ?> </td>
                    <td><?= $form->field($value, "[$key]to_url")->label(false) ?>  </td>
                    <td>
                        <?php if (!$value->isNewRecord): ?>
                            <a class="btn btn-danger btn-xs" href="<?= Url::to(['delete', 'id' => $value->id]) ?>"><i
                                        class="glyphicon glyphicon-trash"></i> </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> ' . Yii::t('seo', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-plu"></i> ' . Yii::t('seo', 'Add'), ['index', 'add_new' => $add_new + 1], ['class' => 'btn btn-primary ']) ?>
    </div>
    <?php ActiveForm::end() ?>
    <?php Pjax::end() ?>
</div>
