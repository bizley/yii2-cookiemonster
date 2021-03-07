<?php

namespace bizley\tests;

use bizley\cookiemonster\assets\CookieMonsterAsset;
use PHPUnit\Framework\TestCase;

class CookieMonsterAssetTest extends TestCase
{
    public function testDebugAssetInit()
    {
        $asset = new CookieMonsterAsset();
        self::assertSame(['CookieMonster.js'], $asset->js);
    }
}
