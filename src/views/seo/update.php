<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model boryshaiduchuk\seo\models\Seo */

$this->title = Yii::t('seo', 'Update : {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'Seo module'), 'url' => ['/seo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'Seo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('seo', 'Update');
?>
<div class="seo-update">
    <?= \boryshaiduchuk\seo\widgets\SeoEditWidget::widget(['model' => $model]) ?>
</div>
