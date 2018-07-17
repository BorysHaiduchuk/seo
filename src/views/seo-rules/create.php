<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\modules\seo\models\SeoRules */

$this->title = 'Create Seo Rules';
$this->params['breadcrumbs'][] = ['label' => 'Seo Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-rules-create">

    <div class="seo-rules-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'model_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList($model::getStatusList()) ?>

        <?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>


        <div class="form-group">
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> '.'Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
