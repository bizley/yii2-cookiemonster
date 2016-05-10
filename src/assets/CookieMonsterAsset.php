<?php

namespace bizley\cookiemonster\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the CookieMonster javascript file.
 * 
 * @author Paweł Bizley Brzozowski
 * @version 1.0.1
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
class CookieMonsterAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bizley/cookiemonster/src/js';
    public $depends = ['yii\web\JqueryAsset'];
    
    /**
     * Registers js file (minimised for production).
     * @since 1.0.1
     */
    public function init()
    {
        $this->js[] = 'CookieMonster' . (YII_DEBUG ? '' : '.min') . '.js';
        parent::init();
    }
}
