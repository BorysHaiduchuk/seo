<?php

use yii\helpers\Html;
use yii\grid\GridView;



/* @var $this yii\web\View */
/* @var $searchModel backend\modules\seo\models\SeoRulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seo Rules';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="seo-rules-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <span>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i>' .' Create', ['create'], ['class' => 'btn btn-success']) ?>
    </span>

    <div class="pull-right">

    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'class'=>'table table-custom dataTable no-footer',
        'tableOptions'=>['class'=>'table table-custom dataTable no-footer'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'model_name',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusDetail;
                },
                'filter' => $searchModel::getStatusList()
            ],
            'created_at:datetime',
            'updated_at:datetime',
            //'hint',
            //'additional_data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
