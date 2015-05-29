<?php
use yii\helpers\Html;
?>
<?= Html::beginTag('div', $outerHtmlOptions) ?>
<?= Html::beginTag('div', $innerHtmlOptions) ?>
<?= Yii::t($content['category'], $content['mainMessage'], $content['mainParams'], $content['language']) ?>
<?= Html::button(Yii::t($content['category'], $content['buttonMessage'], $content['buttonParams'], $content['language']), $buttonHtmlOptions) ?>
<?= Html::endTag('div'); ?>
<?= Html::endTag('div') . "\n"; ?>