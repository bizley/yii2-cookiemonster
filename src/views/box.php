<?php

use yii\helpers\Html;

/**
 * CookieMonster view file.
 * 
 * @author Paweł Bizley Brzozowski
 * @version 1.1.0
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

/** @var array $outerHtmlOptions */
/** @var array $innerHtmlOptions */
/** @var array $content */
/** @var array $buttonHtmlOptions */

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
