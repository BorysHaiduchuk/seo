<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model boryshaiduchuk\seo\models\SeoRules */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'Seo Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-rules-view">

    <p>
        <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('seo', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o"></i> ' . Yii::t('seo', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa  fa-refresh"></i> ' . Yii::t('seo', 'Regenerate'), ['generate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'model_name',
            'statusDetail',
            'created_at:datetime',
            'updated_at:datetime',
            'hint',
            'additional_data',
        ],
    ]) ?>

</div>
