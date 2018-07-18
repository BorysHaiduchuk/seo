<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\elfinder\InputFile;

?>

<div class="edit-seo">
    <div class="col-md-8">
        <?php $form = ActiveForm::begin([
            'id' => 'form-seo-edit',
            'action' => [
                '/seo/default/edit-seo',
                'table_name' => $model->table_name,
                'model_id' => $model->model_id,
                'seo_rules_id' => $model->seo_rules_id
            ]
        ]) ?>

        <?= $form->field($model, 'title')->textInput() ?>

        <?= $form->field($model, 'description')->textarea() ?>

        <?= $form->field($model, 'h1')->textInput() ?>

        <?= $form->field($model, 'keywords')->textarea() ?>

        <?= $form->field($model, 'og_title')->textInput() ?>

        <?= $form->field($model, 'og_description')->textarea() ?>

        <?= $form->field($model, 're_generate')->checkbox() ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'og_image')->widget(InputFile::className(), [
                    'language' => 'ru',
                    'path' => 'news',
                    'controller' => '/elfinder',
                    'template' => '<div class="file-input-image"><div class="input-group">{input}<span class="input-group-btn">{button}</span></div> </div> ',
                    'options' => ['class' => 'form-control'],
                    'buttonOptions' => ['class' => 'btn btn-news'],
                    'multiple' => false
                ])->label(false); ?>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="form-group">
            <br>
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> ' . Yii::t('seo', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>