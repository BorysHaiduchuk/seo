<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model boryshaiduchuk\seo\models\SeoRules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-rules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_template')->textInput(['maxlength' => true,]) ?>

    <?= $form->field($model, 'description_template')->textarea() ?>

    <?= $form->field($model, 'keywords_template')->textarea() ?>

    <?= $form->field($model, 'h1_template')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'og_title_template')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'og_description_template')->textarea() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'model_name')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'status')->dropDownList($model::getStatusList()) ?>

    <?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 're_generate')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> ' . Yii::t('seo', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
