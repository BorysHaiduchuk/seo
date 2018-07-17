<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\seo\models\Seo */

$this->title = Yii::t('app', 'Update : {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="seo-update">

    <?=  \backend\modules\seo\widgets\SeoEditWidget::widget(['model' => $model]) ?>

</div>
