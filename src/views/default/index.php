<?php

use yii\bootstrap\Html;

$this->title = Yii::t('seo', 'Seo module');
?>
<div class="seo-default-index">
    <h1><?= Yii::t('seo', 'Seo module') ?></h1>
    <div>
        <ul>
            <li>
                <?= Html::a(Yii::t('seo', 'Seo redirect'), ['seo-redirect/index']) ?> -
                <?= Yii::t('seo', 'Setting up redirects for pages') ?>
            </li>
            <li>
                <?= Html::a(Yii::t('seo', 'Seo rules'), ['seo-rules/index']) ?> -
                <?= Yii::t('seo', 'Generation rules for seo tags') ?>
            </li>
            <li>
                <?= Html::a(Yii::t('seo', 'Seo data'), ['seo/index']) ?> -
                <?= Yii::t('seo', 'Generation rules for seo tags') ?>
            </li>
        </ul>
    </div>
</div>
