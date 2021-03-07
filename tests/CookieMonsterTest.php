<?php

namespace bizley\tests;

use bizley\cookiemonster\CookieMonster;
use PHPUnit\Framework\TestCase;

class CookieMonsterTest extends TestCase
{
    public function providerForAddClassOption()
    {
        return [
            'empty string' => ['', []],
            'null' => [null, []],
            'non-string' => [1, ['name' => '1']],
            'with spaces' => [' a ', ['name' => 'a']],
            'with dot' => ['.a', ['name' => 'a']],
            'with hash' => ['#a', ['name' => 'a']],
            'ok' => ['a', ['name' => 'a']],
        ];
    }

    /**
     * @dataProvider providerForAddClassOption
     */
    public function testAddClassOption($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addClassOption('name', $value);

        self::assertSame($expected, $cookie->getClassOptions());
    }

    public function providerForAddContentOption()
    {
        return [
            'empty string' => ['', []],
            'null' => [null, []],
            'with spaces' => [' a ', ['name' => 'a']],
            'non-string' => [1, ['name' => '1']],
            'ok' => ['a', ['name' => 'a']],
        ];
    }

    /**
     * @dataProvider providerForAddContentOption
     */
    public function testAddContentOption($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addContentOption('name', $value);

        self::assertSame($expected, $cookie->getContentOptions());
    }

    public function providerForAddCookieBoolOption()
    {
        return [
            'non-boolean' => ['', []],
            'true' => [true, ['name' => true]],
            'false' => [false, ['name' => false]],
        ];
    }

    /**
     * @dataProvider providerForAddCookieBoolOption
     */
    public function testAddCookieBoolOption($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addCookieBoolOption('name', $value);

        self::assertSame($expected, $cookie->getCookieOptions());
    }

    public function providerForAddCookieIntOption()
    {
        return [
            'non-int' => ['a', []],
            'with spaces' => [' 1 ', ['name' => 1]],
            'int' => [1, ['name' => 1]],
            'int string' => ['1', ['name' => 1]],
            'float' => [1.2, ['name' => 1]],
            'float string' => ['1.2', ['name' => 1]],
        ];
    }

    /**
     * @dataProvider providerForAddCookieIntOption
     */
    public function testAddCookieIntOption($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addCookieIntOption('name', $value);

        self::assertSame($expected, $cookie->getCookieOptions());
    }

    public function providerForAddCookieOption()
    {
        return [
            'empty string' => ['', []],
            'null' => ['', []],
            'non-string' => [1, ['name' => '1']],
            'pattern 1' => ['name=a', ['name' => 'a']],
            'pattern 2' => [';name=a', ['name' => 'a']],
            'pattern 3' => [' name=a', ['name' => 'a']],
            'pattern 4' => [' ;name=a', ['name' => 'a']],
            'pattern 5' => ['; name=a', ['name' => 'a']],
            'pattern 6' => [' ; name=a', ['name' => 'a']],
            'ok' => ['a', ['name' => 'a']],
        ];
    }

    /**
     * @dataProvider providerForAddCookieOption
     */
    public function testAddCookieOption($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addCookieOption('name', $value);

        self::assertSame($expected, $cookie->getCookieOptions());
    }

    public function providerForAddCookieSameSiteOption()
    {
        return [
            'invalid' => ['invalid', []],
            'strict' => ['strict', ['sameSite' => 'strict']],
            'lax' => ['lax', ['sameSite' => 'lax']],
            'none' => ['none', ['sameSite' => 'none']],
        ];
    }

    /**
     * @dataProvider providerForAddCookieSameSiteOption
     */
    public function testAddCookieSameSiteOption($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addCookieOption('sameSite', $value);

        self::assertSame($expected, $cookie->getCookieOptions());
    }

    public function testAddNonExistingOption()
    {
        $cookie = new CookieMonster();
        $this->expectException('yii\base\UnknownPropertyException');
        $cookie->addOption('nonexisting', 'name', 'value');
    }

    public function providerForAddParamsOption()
    {
        return [
            'ok' => [['a' => 1], ['name' => ['a' => 1]]],
            'non-array' => ['a', []],
            'empty array' => [[], []],
        ];
    }

    /**
     * @dataProvider providerForAddParamsOption
     */
    public function testAddParamsOption($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addParamsOption('name', $value);

        self::assertSame($expected, $cookie->getContentOptions());
    }

    public function providerForAddStyle()
    {
        return [
            'ok' => [['a' => '1'], ['a' => '1']],
            'non-array' => ['a', []],
            'empty array' => [[], []],
            'empty array value' => [['a' => null], []],
            'non-string array value' => [['a' => 1], []],
            'value with semicolon' => [['a' => 'a;'], ['a' => 'a']],
            'value with white spaces' => [['a' => ' a '], ['a' => 'a']],
        ];
    }

    /**
     * @dataProvider providerForAddStyle
     */
    public function testAddInnerStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setInnerStyle(['e' => 'f']);
        $cookie->addInnerStyle($value);

        self::assertSame(['e' => 'f'] + $expected, $cookie->getInnerStyle());
    }

    /**
     * @dataProvider providerForAddStyle
     */
    public function testAddOuterStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setOuterStyle(['e' => 'f']);
        $cookie->addOuterStyle($value);

        self::assertSame(['e' => 'f'] + $expected, $cookie->getOuterStyle());
    }

    /**
     * @dataProvider providerForAddStyle
     */
    public function testAddButtonStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setButtonStyle(['e' => 'f']);
        $cookie->addButtonStyle($value);

        self::assertSame(['e' => 'f'] + $expected, $cookie->getButtonStyle());
    }

    public function providerForReplaceStyle()
    {
        return [
            'different key' => [['b' => '1'], ['a' => 'b']],
            'unset with false' => [['a' => false], []],
            'unset with null' => [['a' => null], []],
            'not replaced' => [['a' => 1], ['a' => 'b']],
            'replaced' => [['a' => 'c'], ['a' => 'c']],
            'replaced with semicolon' => [['a' => ';c'], ['a' => 'c']],
            'replaced with white spaces' => [['a' => ' c '], ['a' => 'c']],
        ];
    }

    /**
     * @dataProvider providerForReplaceStyle
     */
    public function testReplaceInnerStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addInnerStyle(['a' => 'b']);
        $cookie->replaceInnerStyle($value);

        self::assertSame($expected, $cookie->getInnerStyle());
    }

    /**
     * @dataProvider providerForReplaceStyle
     */
    public function testReplaceOuterStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addOuterStyle(['a' => 'b']);
        $cookie->replaceOuterStyle($value);

        self::assertSame($expected, $cookie->getOuterStyle());
    }

    /**
     * @dataProvider providerForReplaceStyle
     */
    public function testReplaceButtonStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->addButtonStyle(['a' => 'b']);
        $cookie->replaceButtonStyle($value);

        self::assertSame($expected, $cookie->getButtonStyle());
    }

    public function providerForHtmlOptions()
    {
        return [
            'non-array' => ['b', []],
            'empty array' => [[], []],
            'array with class' => [['class' => 'a'], []],
            'array with style' => [['style' => 'a'], []],
            'array with non-string' => [['a' => 1], []],
            'array with white space' => [['a' => ' a '], ['a' => 'a']],
            'ok' => [['a' => 'b'], ['a' => 'b']],
        ];
    }

    /**
     * @dataProvider providerForHtmlOptions
     */
    public function testSetInnerHtmlOptions($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setInnerHtmlOptions($value);

        self::assertSame($expected, $cookie->getInnerHtml());
    }

    /**
     * @dataProvider providerForHtmlOptions
     */
    public function testSetOuterHtmlOptions($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setOuterHtmlOptions($value);

        self::assertSame($expected, $cookie->getOuterHtml());
    }

    /**
     * @dataProvider providerForHtmlOptions
     */
    public function testSetButtonHtmlOptions($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setButtonHtmlOptions($value);

        self::assertSame($expected, $cookie->getButtonHtml());
    }

    /**
     * @dataProvider providerForAddStyle
     */
    public function testSetInnerStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setInnerStyle($value);

        self::assertSame($expected, $cookie->getInnerStyle());
    }

    /**
     * @dataProvider providerForAddStyle
     */
    public function testSetOuterStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setOuterStyle($value);

        self::assertSame($expected, $cookie->getOuterStyle());
    }

    /**
     * @dataProvider providerForAddStyle
     */
    public function testSetButtonStyle($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setButtonStyle($value);

        self::assertSame($expected, $cookie->getButtonStyle());
    }

    public function providerForCookieView()
    {
        return [
            'empty string' => ['', ''],
            'null' => [null, ''],
            'non-string' => [1, '1'],
            'with spaces' => [' a ', 'a'],
        ];
    }

    /**
     * @dataProvider providerForCookieView
     */
    public function testSetCookieView($value, $expected)
    {
        $cookie = new CookieMonster();
        $cookie->setCookieView($value);

        self::assertSame($expected, $cookie->getCookieView());
    }

    public function testDefaultTopModeRun()
    {
        $cookie = new CookieMonster(['view' => new FakeView()]);

        self::assertSame('<div class="CookieMonsterBox" style="display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;top:0;left:0;width:100%;box-shadow:0 2px 2px #000"><div class="" style="margin:10px">We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.<button type="button" class="CookieMonsterOk" style="margin-left:10px">I understand</button></div></div>
', $cookie->run());
        self::assertSame('box', FakeView::$viewName);
        self::assertSame(
            [
                'content' => [
                    'category' => 'app',
                    'mainParams' => [],
                    'buttonParams' => [],
                    'language' => null,
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                    'buttonMessage' => 'I understand',
                ],
                'outerHtmlOptions' => [
                    'style' => 'display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;top:0;left:0;width:100%;box-shadow:0 2px 2px #000',
                    'class' => 'CookieMonsterBox',
                ],
                'innerHtmlOptions' => [
                    'style' => 'margin:10px',
                    'class' => '',
                ],
                'buttonHtmlOptions' => [
                    'style' => 'margin-left:10px',
                    'class' => 'CookieMonsterOk',
                ],
                'params' => null,
            ],
            FakeView::$params
        );
        self::assertSame('bizley\cookiemonster\assets\CookieMonsterAsset', FakeView::$assetName);
        self::assertSame(
            ['CookieMonster.init({"path":"/","expires":30,"secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'],
            FakeView::$js
        );
    }

    public function testCustomModeRun()
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'mode' => 'custom',
                'cookieView' => 'sesese'
            ]
        );
        $cookie->run();
        self::assertSame('sesese', FakeView::$viewName);
    }

    public function testBottomModeRun()
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'mode' => 'bottom',
            ]
        );
        self::assertSame('<div class="CookieMonsterBox" style="display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;bottom:0;left:0;width:100%;box-shadow:0 -2px 2px #000"><div class="" style="margin:10px">We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.<button type="button" class="CookieMonsterOk" style="margin-left:10px">I understand</button></div></div>
', $cookie->run());
        self::assertSame('box', FakeView::$viewName);
        self::assertSame(
            [
                'content' => [
                    'category' => 'app',
                    'mainParams' => [],
                    'buttonParams' => [],
                    'language' => null,
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                    'buttonMessage' => 'I understand',
                ],
                'outerHtmlOptions' => [
                    'style' => 'display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;bottom:0;left:0;width:100%;box-shadow:0 -2px 2px #000',
                    'class' => 'CookieMonsterBox',
                ],
                'innerHtmlOptions' => [
                    'style' => 'margin:10px',
                    'class' => '',
                ],
                'buttonHtmlOptions' => [
                    'style' => 'margin-left:10px',
                    'class' => 'CookieMonsterOk',
                ],
                'params' => null,
            ],
            FakeView::$params
        );
        self::assertSame('bizley\cookiemonster\assets\CookieMonsterAsset', FakeView::$assetName);
        self::assertSame(
            ['CookieMonster.init({"path":"/","expires":30,"secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'],
            FakeView::$js
        );
    }

    public function testBoxModeRun()
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'mode' => 'box',
            ]
        );
        self::assertSame('<div class="CookieMonsterBox" style="display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;bottom:20px;right:20px;width:300px;box-shadow:-2px 2px 2px #000;border-radius:10px"><div class="" style="margin:10px">We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.<button type="button" class="CookieMonsterOk" style="margin-left:10px">I understand</button></div></div>
', $cookie->run());
        self::assertSame('box', FakeView::$viewName);
        self::assertSame(
            [
                'content' => [
                    'category' => 'app',
                    'mainParams' => [],
                    'buttonParams' => [],
                    'language' => null,
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                    'buttonMessage' => 'I understand',
                ],
                'outerHtmlOptions' => [
                    'style' => 'display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;bottom:20px;right:20px;width:300px;box-shadow:-2px 2px 2px #000;border-radius:10px',
                    'class' => 'CookieMonsterBox',
                ],
                'innerHtmlOptions' => [
                    'style' => 'margin:10px',
                    'class' => '',
                ],
                'buttonHtmlOptions' => [
                    'style' => 'margin-left:10px',
                    'class' => 'CookieMonsterOk',
                ],
                'params' => null,
            ],
            FakeView::$params
        );
        self::assertSame('bizley\cookiemonster\assets\CookieMonsterAsset', FakeView::$assetName);
        self::assertSame(
            ['CookieMonster.init({"path":"/","expires":30,"secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'],
            FakeView::$js
        );
    }

    public function providerForCookieParams()
    {
        return [
            'domain' => [
                ['domain' => 'example.com'],
                'CookieMonster.init({"domain":"example.com","path":"/","expires":30,"secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'
            ],
            'path' => [
                ['path' => '/a'],
                'CookieMonster.init({"path":"/a","expires":30,"secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'
            ],
            'max-age' => [
                ['max-age' => 1],
                'CookieMonster.init({"max-age":1,"path":"/","expires":30,"secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'
            ],
            'expires' => [
                ['expires' => 1],
                'CookieMonster.init({"expires":1,"path":"/","secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'
            ],
            'secure' => [
                ['secure' => true],
                'CookieMonster.init({"secure":true,"path":"/","expires":30,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'
            ],
            'sameSite' => [
                ['sameSite' => 'lax'],
                'CookieMonster.init({"sameSite":"lax","path":"/","expires":30,"secure":false,"classOuter":"CookieMonsterBox","classInner":"","classButton":"CookieMonsterOk"});'
            ],
        ];
    }

    /**
     * @dataProvider providerForCookieParams
     */
    public function testCookieParamsRun($config, $js)
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'cookie' => $config,
            ]
        );
        $cookie->run();
        self::assertSame([$js], FakeView::$js);
    }

    public function providerForContentParams()
    {
        return [
            'category' => [
                ['category' => 'bizley'],
                [
                    'category' => 'bizley',
                    'mainParams' => [],
                    'buttonParams' => [],
                    'language' => null,
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                    'buttonMessage' => 'I understand',
                ]
            ],
            'mainMessage' => [
                ['mainMessage' => 'msg'],
                [
                    'mainMessage' => 'msg',
                    'category' => 'app',
                    'mainParams' => [],
                    'buttonParams' => [],
                    'language' => null,
                    'buttonMessage' => 'I understand',
                ]
            ],
            'buttonMessage' => [
                ['buttonMessage' => 'msg'],
                [
                    'buttonMessage' => 'msg',
                    'category' => 'app',
                    'mainParams' => [],
                    'buttonParams' => [],
                    'language' => null,
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                ]
            ],
            'language' => [
                ['language' => 'pl'],
                [
                    'language' => 'pl',
                    'category' => 'app',
                    'mainParams' => [],
                    'buttonParams' => [],
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                    'buttonMessage' => 'I understand',
                ]
            ],
            'mainParams' => [
                ['mainParams' => ['a']],
                [
                    'mainParams' => ['a'],
                    'category' => 'app',
                    'buttonParams' => [],
                    'language' => null,
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                    'buttonMessage' => 'I understand',
                ]
            ],
            'buttonParams' => [
                ['buttonParams' => ['a']],
                [
                    'buttonParams' => ['a'],
                    'category' => 'app',
                    'mainParams' => [],
                    'language' => null,
                    'mainMessage' => 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.',
                    'buttonMessage' => 'I understand',
                ]
            ],
        ];
    }

    /**
     * @dataProvider providerForContentParams
     */
    public function testContentParamsRun($config, $params)
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'content' => $config,
            ]
        );
        $cookie->run();
        self::assertSame($params, FakeView::$params['content']);
    }

    public function providerForOuterHtmlOptionsParams()
    {
        return [
            'classOuter' => [
                ['classOuter' => 'custom'],
                [
                    'style' => 'display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;top:0;left:0;width:100%;box-shadow:0 2px 2px #000',
                    'class' => 'custom'
                ]
            ],
            'replaceOuterStyle' => [
                ['replaceOuterStyle' => ['z-index' => '1']],
                [
                    'style' => 'display:none;z-index:1;position:fixed;background-color:#fff;font-size:12px;color:#000;top:0;left:0;width:100%;box-shadow:0 2px 2px #000',
                    'class' => 'CookieMonsterBox'
                ]
            ],
            'addOuterStyle' => [
                ['addOuterStyle' => ['a' => 'b']],
                [
                    'style' => 'display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;top:0;left:0;width:100%;box-shadow:0 2px 2px #000;a:b',
                    'class' => 'CookieMonsterBox'
                ]
            ],
            'setOuterStyle' => [
                ['setOuterStyle' => ['a' => 'b']],
                [
                    'style' => 'a:b',
                    'class' => 'CookieMonsterBox'
                ]
            ],
            'outerHtmlOptions' => [
                ['outerHtmlOptions' => ['a' => 'b']],
                [
                    'a' => 'b',
                    'style' => 'display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;top:0;left:0;width:100%;box-shadow:0 2px 2px #000',
                    'class' => 'CookieMonsterBox'
                ]
            ],
        ];
    }

    /**
     * @dataProvider providerForOuterHtmlOptionsParams
     */
    public function testOuterHtmlOptionsParamsRun($config, $params)
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'box' => $config,
            ]
        );
        $cookie->run();
        self::assertSame($params, FakeView::$params['outerHtmlOptions']);
    }

    public function providerForInnerHtmlOptionsParams()
    {
        return [
            'classInner' => [
                ['classInner' => 'custom'],
                [
                    'style' => 'margin:10px',
                    'class' => 'custom'
                ]
            ],
            'replaceInnerStyle' => [
                ['replaceInnerStyle' => ['margin' => '15px']],
                [
                    'style' => 'margin:15px',
                    'class' => ''
                ]
            ],
            'addInnerStyle' => [
                ['addInnerStyle' => ['a' => 'b']],
                [
                    'style' => 'margin:10px;a:b',
                    'class' => ''
                ]
            ],
            'setInnerStyle' => [
                ['setInnerStyle' => ['a' => 'b']],
                [
                    'style' => 'a:b',
                    'class' => ''
                ]
            ],
            'innerHtmlOptions' => [
                ['innerHtmlOptions' => ['a' => 'b']],
                [
                    'a' => 'b',
                    'style' => 'margin:10px',
                    'class' => ''
                ]
            ],
        ];
    }

    /**
     * @dataProvider providerForInnerHtmlOptionsParams
     */
    public function testInnerHtmlOptionsParamsRun($config, $params)
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'box' => $config,
            ]
        );
        $cookie->run();
        self::assertSame($params, FakeView::$params['innerHtmlOptions']);
    }

    public function providerForButtonHtmlOptionsParams()
    {
        return [
            'classButton' => [
                ['classButton' => 'custom'],
                [
                    'style' => 'margin-left:10px',
                    'class' => 'custom'
                ]
            ],
            'replaceButtonStyle' => [
                ['replaceButtonStyle' => ['margin-left' => '15px']],
                [
                    'style' => 'margin-left:15px',
                    'class' => 'CookieMonsterOk'
                ]
            ],
            'addButtonStyle' => [
                ['addButtonStyle' => ['a' => 'b']],
                [
                    'style' => 'margin-left:10px;a:b',
                    'class' => 'CookieMonsterOk'
                ]
            ],
            'setButtonStyle' => [
                ['setButtonStyle' => ['a' => 'b']],
                [
                    'style' => 'a:b',
                    'class' => 'CookieMonsterOk'
                ]
            ],
            'buttonHtmlOptions' => [
                ['buttonHtmlOptions' => ['a' => 'b']],
                [
                    'a' => 'b',
                    'style' => 'margin-left:10px',
                    'class' => 'CookieMonsterOk'
                ]
            ],
        ];
    }

    /**
     * @dataProvider providerForButtonHtmlOptionsParams
     */
    public function testButtonHtmlOptionsParamsRun($config, $params)
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'box' => $config,
            ]
        );
        $cookie->run();
        self::assertSame($params, FakeView::$params['buttonHtmlOptions']);
    }

    public function testViewParamRun()
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'box' => ['view' => 'se'],
                'mode' => 'custom',
            ]
        );
        $cookie->run();
        self::assertSame('se', FakeView::$viewName);
    }

    public function testProtectedMethods()
    {
        $cookie = new ExtendedCookieMonster(['view' => new FakeView()]);
        self::assertNull($cookie->run());
    }

    public function testInitCookie()
    {
        $cookie = new CookieMonster(
            [
                'view' => new FakeView(),
                'box' => [
                    'classInner' => 'a b c',
                    'classOuter' => 'd e',
                    'classButton' => 'g h',
                ],
            ]
        );
        $cookie->run();
        self::assertSame(
            ['CookieMonster.init({"path":"/","expires":30,"secure":false,"classOuter":"d.e","classInner":"a.b.c","classButton":"g.h"});'],
            FakeView::$js
        );
    }
}
