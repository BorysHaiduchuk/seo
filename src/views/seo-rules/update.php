<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model boryshaiduchuk\seo\models\SeoRules */

$this->title = Yii::t('seo', 'Update : {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'Seo Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('seo', 'Update');
?>
<div class="seo-rules-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
