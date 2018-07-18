<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\core\models\Setting as ModelData;

/* @var $this yii\web\View */
/* @var $searchModel boryshaiduchuk\seo\models\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'Seo module'), 'url' => ['/seo']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="seo-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'class' => 'table table-custom dataTable no-footer',
        'tableOptions' => ['class' => 'table table-custom dataTable no-footer'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'table_name',
            [
                'attribute' => 'seo_rules_id',
                'label' => 'Rules',
                'filter' => \boryshaiduchuk\seo\models\SeoRules::getRulesAll(true),
                'value' => function ($model) {
                    return $model->rules->name;
                }
            ],
            'title',
            'description',
            'h1',
            'keywords',
            'model_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}'
            ],
        ],
    ]); ?>
</div>
