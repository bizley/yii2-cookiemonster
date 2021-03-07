<?php

namespace bizley\tests;

use yii\web\View;

class FakeView
{
    public static $viewName;
    public static $params;
    public static $assetName;
    public static $js = [];

    public function __construct()
    {
        static::$viewName = null;
        static::$params = null;
        static::$assetName = null;
        static::$js = [];
    }

    public function render($view, $params = [], $context = null)
    {
        static::$viewName = $view;
        static::$params = $params;

        $view = new View();
        return $view->renderPhpFile(__DIR__ . '/../src/views/box.php', $params);
    }

    public function registerAssetBundle($name, $position = null)
    {
        static::$assetName = $name;
    }

    public function registerJs($js, $position = View::POS_READY, $key = null)
    {
        static::$js[] = $js;
    }
}
