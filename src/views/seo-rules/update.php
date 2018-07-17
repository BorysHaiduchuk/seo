<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\seo\models\SeoRules */

$this->title = 'Update : '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Seo Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seo-rules-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
