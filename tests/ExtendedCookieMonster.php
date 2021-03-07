<?php

namespace bizley\tests;

use bizley\cookiemonster\CookieMonster;

class ExtendedCookieMonster extends CookieMonster
{
    protected $classOptions = [
        'classOuter' => [],
        'classInner' => [],
        'classButton' => [],
    ];

    public function run()
    {
        $this->addStyle(0, []);
        $this->checkBox();
        $this->checkContent();
        $this->checkCookie();
        $this->initCookie();
        $this->prepareViewParams();
        $this->replaceStyle(0, []);
        $this->setDefaults();
        $this->setHtmlOptions(0, []);
        $this->setMode();
        $this->setStyle(0, []);
    }
}
