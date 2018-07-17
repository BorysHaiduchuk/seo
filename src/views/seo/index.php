<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\core\models\Setting as ModelData;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\seo\models\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seo');
$this->params['breadcrumbs'][] = $this->title;

\backend\widgets\SortActionWidget::widget(['className' => ModelData::className()]);
?>
<div class="seo-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'class'=>'table table-custom dataTable no-footer',
        'tableOptions'=>['class'=>'table table-custom dataTable no-footer'],
        'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            'table_name',
            [
                'attribute' => 'seo_rules_id',
                'label' => 'Rules',
                'filter' => \backend\modules\seo\models\SeoRules::getRulesAll(true),
                'value' => function ($model){
                    return $model->rules->name;
                }
            ],
            'title',
            'description',
            'h1',
            'keywords',
            //'model_id',
            're_generate',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}'
            ],
        ],
    ]); ?>
</div>
