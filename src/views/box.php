<?php

/**
 * CookieMonster view file.
 * 
 * @author Paweł Bizley Brzozowski
 * @version 1.0.1
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
use yii\helpers\Html;

echo Html::beginTag('div', $outerHtmlOptions);
echo Html::beginTag('div', $innerHtmlOptions);
echo Yii::t(
        $content['category'], 
        $content['mainMessage'], 
        $content['mainParams'], 
        $content['language']
    );
echo Html::button(
        Yii::t(
            $content['category'], 
            $content['buttonMessage'], 
            $content['buttonParams'], 
            $content['language']
        ), 
        $buttonHtmlOptions
    );
echo Html::endTag('div');
echo Html::endTag('div') . "\n";
