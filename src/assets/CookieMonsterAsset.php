<?php

/**
 * @author Paweł Bizley Brzozowski
 * @version 1.0
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace bizley\cookiemonster\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the CookieMonster javascript file.
 */
class CookieMonsterAsset extends AssetBundle
{

    public $sourcePath = '@vendor/bizley/cookiemonster/src/js';
    public $js         = ['CookieMonster.js'];
    public $depends    = ['yii\web\JqueryAsset'];
}