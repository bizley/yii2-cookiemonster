<?php

namespace bizley\cookiemonster;

use yii\base\Widget;
use yii\helpers\Json;

/**
 * CookieMonster is the Yii widget that adds warning about website cookies
 * https://github.com/bizley/yii2-cookiemonster
 * http://www.yiiframework.com/extension/yii2-cookiemonster
 *
 * See README file for configuration and usage examples.
 *
 * CookieMonster requires Yii 2.
 * http://www.yiiframework.com
 * https://github.com/yiisoft/yii2
 *
 * For Yii 1.1 version of this widget see
 * https://github.com/bizley/Yii-CookieMonster
 *
 * @author Paweł Bizley Brzozowski
 * @version 1.1.0
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
class CookieMonster extends Widget
{
    /**
     * @var array parameters for the CSS class and style and other HTML options for the view containers.
     * Available options:
     * - addButtonStyle: array
     *      list of button CSS style options to be added or replaced with new values
     *      i.e. 'padding-right' => '20px', 'font-weight' => 'bold'
     * - addInnerStyle: array
     *      list of inner div CSS style options to be added or replaced with new values
     * - addOuterStyle: array
     *      list of outer div CSS style options to be added or replaced with new values
     * - buttonHtmlOptions: array
     *      list of button HTML options to be added (except style and class)
     * - classButton: string
     *      button class or classes (separated by spaces), default 'CookieMonsterOk'
     * - classInner: string
     *      inner div class or classes (separated by spaces)
     * - classOuter: string
     *      outer div class or classes (separated by spaces), default 'CookieMonsterBox'
     * - innerHtmlOptions: array
     *      list of inner div HTML options to be added (except style and class)
     * - outerHtmlOptions: array
     *      list of outer div HTML options to be added (except style and class)
     * - replaceButtonStyle: array
     *      list of button CSS style options to be replaced with new values or removed
     *      i.e. 'margin-left' => '10px', 'font-size' => false
     * - replaceInnerStyle: array
     *      list of inner div CSS style options to be replaced with new values or removed
     * - replaceOuterStyle: array
     *      list of outer div CSS style options to be replaced with new values or removed
     * - setButtonStyle: array
     *      list of button CSS style options to be set replacing the default ones
     * - setInnerStyle: array
     *      list of inner div CSS style options to be set replacing the default ones
     * - setOuterStyle: array
     *      list of outer div CSS style options to be set replacing the default ones
     * - view: string
     *      path to the custom view (required if $mode is set to 'custom'), for views outside the widget folder
     *      use alias path, i.e. '@app/views/cookie'
     */
    public $box = [];

    /**
     * @var array parameters for the texts.
     * Available options:
     * - buttonMessage: string
     *      button original message as in Yii::t() $message, default 'I understand'
     * - buttonParams: array
     *      parameters to be applied to the buttonMessage as in Yii::t() $params, default []
     * - category: string
     *      message category as in Yii::t() $category, default 'app'
     * - language: string
     *      target language as in Yii::t() $language, default null
     * - mainMessage: string
     *      main original message as in Yii::t() $message, default 'We use cookies on our websites to help us offer you
     *      the best online experience. By continuing to use our website, you are agreeing to our use of cookies.
     *      Alternatively, you can manage them in your browser settings.'
     * - mainParams: array
     *      parameters to be applied to the mainMessage as in Yii::t() $params, default []
     */
    public $content = [];

    /**
     * @var array parameters for the cookie
     * @see https://developer.mozilla.org/en-US/docs/Web/API/Document/cookie
     * Available options:
     * - domain: string
     *      domain name for the cookie, default host portion of the current document location
     * - expires: integer
     *      number of days this cookie will be valid for, default 30
     * - max-age: integer
     *      max cookie age in seconds
     * - path: string
     *      path for the cookie, default '/'
     * - secure: boolean
     *      whether cookie should be transmitted over secure protocol as https, default false
     * - sameSite: string
     *      either 'strict', 'lax' (default), or 'none'
     */
    public $cookie = [];

    /**
     * @var string name of the mode to be used
     * Available options:
     * - bottom:  bottom strip
     * - box:     bottom right box
     * - custom:  custom mode defined by user (requires $box[view] to be set)
     * - top:     top strip, default
     */
    public $mode = 'top';

    /**
     * @var mixed parameter or parameters passed to the custom user's view in case this is needed
     */
    public $params;

    /**
     * @var array list of button's HTML options
     */
    protected $buttonHtml = [];

    /**
     * @var array list of button's CSS styles
     */
    protected $buttonStyle = [];

    /**
     * @var array list of CSS class options
     */
    protected $classOptions = [];

    /**
     * @var array list of content options
     */
    protected $contentOptions = [];

    /**
     * @var array list of cookie options
     */
    protected $cookieOptions = [];

    /**
     * @var string custom view path
     */
    protected $cookieView = '';

    /**
     * @var array list of inner div HTML options
     */
    protected $innerHtml = [];

    /**
     * @var array list of inner div CSS styles
     */
    protected $innerStyle = [];

    /**
     * @var array list of outer div HTML options
     */
    protected $outerHtml = [];

    /**
     * @var array list of outer div CSS styles
     */
    protected $outerStyle = [];

    /**
     * Adds class option, removes dot and hash.
     * @param mixed $name option name
     * @param mixed $value option value
     * Since 1.1 this method is public.
     */
    public function addClassOption($name, $value)
    {
        if (!empty($value)) {
            $value = trim($value);
            if (strpos($value, '.') === 0 || strpos($value, '#') === 0) {
                $value = substr($value, 1);
            }
            if ($value !== '') {
                $this->addOption('class', $name, $value);
            }
        }
    }

    /**
     * Adds content option.
     * @param mixed $name option name
     * @param mixed $value option value
     * Since 1.1 this method is public.
     */
    public function addContentOption($name, $value)
    {
        if (!empty($value)) {
            $this->addOption('content', $name, trim($value));
        }
    }

    /**
     * Adds boolean cookie option.
     * @param mixed $name option name
     * @param bool|mixed $value option value
     * Since 1.1 this method is public.
     */
    public function addCookieBoolOption($name, $value)
    {
        if ($value !== null) {
            $this->addOption('cookie', $name, (bool)$value);
        }
    }

    /**
     * Adds integer cookie option.
     * @param mixed $name option name
     * @param mixed $value option value
     * Since 1.1 this method is public.
     */
    public function addCookieIntOption($name, $value)
    {
        if ($value !== null) {
            $this->addOption('cookie', $name, (int)$value);
        }
    }

    /**
     * Adds cookie option, removes '; name=' part.
     * @param mixed $name option name
     * @param mixed $value option value
     * Since 1.1 this method is public.
     */
    public function addCookieOption($name, $value)
    {
        $value = preg_replace("~^;? ?$name=~", '', trim($value));
        if ($value !== '') {
            if ($name === 'sameSite' && !in_array($value, ['strict', 'lax', 'none'])) {
                return;
            }
            $this->addOption('cookie', $name, $value);
        }
    }

    /**
     * Adds option of certain type.
     * @param mixed $type type name
     * @param mixed $name option name
     * @param mixed $value option value
     * Since 1.1 this method is public.
     */
    public function addOption($type, $name, $value)
    {
        $this->{$type . 'Options'}[$name] = $value;
    }

    /**
     * Adds content parameters option.
     * @param mixed $name option name
     * @param array $value list of parameters
     * Since 1.1 this method is public.
     */
    public function addParamsOption($name, $value)
    {
        if ($value && is_array($value)) {
            $this->addOption('content', $name, $value);
        }
    }

    /**
     * Adds the CSS styles for selected part.
     * @param int $what number of part
     * @param array $value list of styles
     */
    protected function addStyle($what, $value)
    {
        if (is_array($value)) {
            $type = 'inner';
            switch ($what) {
                case 0:
                    $type = 'outer';
                    break;
                case 2:
                    $type = 'button';
                    break;
            }
            foreach ($value as $name => $set) {
                if (!empty($set) && is_string($set)) {
                    $this->{$type . 'Style'}[$name] = str_replace(';', '', trim($set));
                }
            }
        }
    }

    /**
     * Adds the CSS styles for inner part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function addInnerStyle($value)
    {
        $this->addStyle(1, $value);
    }

    /**
     * Adds the CSS styles for outer part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function addOuterStyle($value)
    {
        $this->addStyle(0, $value);
    }

    /**
     * Adds the CSS styles for button part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function addButtonStyle($value)
    {
        $this->addStyle(2, $value);
    }

    /**
     * Validates box parameters.
     */
    protected function checkBox()
    {
        if (is_array($this->box)) {
            foreach ($this->box as $name => $value) {
                switch ($name) {
                    case 'classOuter':
                        $this->addClassOption('classOuter', $value);
                        break;
                    case 'classButton':
                        $this->addClassOption('classButton', $value);
                        break;
                    case 'classInner':
                        $this->addClassOption('classInner', $value);
                        break;
                    case 'replaceOuterStyle':
                        $this->replaceOuterStyle($value);
                        break;
                    case 'replaceInnerStyle':
                        $this->replaceInnerStyle($value);
                        break;
                    case 'replaceButtonStyle':
                        $this->replaceButtonStyle($value);
                        break;
                    case 'addOuterStyle':
                        $this->addOuterStyle($value);
                        break;
                    case 'addInnerStyle':
                        $this->addInnerStyle($value);
                        break;
                    case 'addButtonStyle':
                        $this->addButtonStyle($value);
                        break;
                    case 'setOuterStyle':
                        $this->setOuterStyle($value);
                        break;
                    case 'setInnerStyle':
                        $this->setInnerStyle($value);
                        break;
                    case 'setButtonStyle':
                        $this->setButtonStyle($value);
                        break;
                    case 'view':
                        $this->setCookieView($value);
                        break;
                    case 'outerHtmlOptions':
                        $this->setOuterHtmlOptions($value);
                        break;
                    case 'innerHtmlOptions':
                        $this->setInnerHtmlOptions($value);
                        break;
                    case 'buttonHtmlOptions':
                        $this->setButtonHtmlOptions($value);
                        break;
                }
            }
        }
    }

    /**
     * Validates content parameters.
     */
    protected function checkContent()
    {
        if (is_array($this->content)) {
            foreach ($this->content as $name => $value) {
                switch ($name) {
                    case 'category':
                    case 'mainMessage':
                    case 'buttonMessage':
                    case 'language':
                        $this->addContentOption($name, $value);
                        break;
                    case 'mainParams':
                    case 'buttonParams':
                        $this->addParamsOption($name, $value);
                        break;
                }
            }
        }
    }

    /**
     * Validates cookie parameters.
     */
    protected function checkCookie()
    {
        if (is_array($this->cookie)) {
            foreach ($this->cookie as $name => $value) {
                switch ($name) {
                    case 'domain':
                    case 'path':
                    case 'sameSite':
                        $this->addCookieOption($name, $value);
                        break;
                    case 'max-age':
                    case 'expires':
                        $this->addCookieIntOption($name, $value);
                        break;
                    case 'secure':
                        $this->addCookieBoolOption($name, $value);
                        break;
                }
            }
        }
    }

    /**
     * Initialises the JS file, prepares the JSON js options.
     */
    protected function initCookie()
    {
        $cookieOptions = Json::encode(
            array_merge(
                $this->cookieOptions,
                [
                    'classOuter' => str_replace(' ', '.', $this->classOptions['classOuter']),
                    'classInner' => str_replace(' ', '.', $this->classOptions['classInner']),
                    'classButton' => str_replace(' ', '.', $this->classOptions['classButton']),
                ]
            )
        );
        $view = $this->getView();
        assets\CookieMonsterAsset::register($view);
        $view->registerJs("CookieMonster.init($cookieOptions);");
    }

    /**
     * Prepares the list of parameters to send to the view.
     * @return array
     */
    protected function prepareViewParams()
    {
        $outerStyle = [];
        $innerStyle = [];
        $buttonStyle = [];

        foreach ($this->outerStyle as $name => $value) {
            $outerStyle[] = $name . ':' . $value;
        }
        foreach ($this->innerStyle as $name => $value) {
            $innerStyle[] = $name . ':' . $value;
        }
        foreach ($this->buttonStyle as $name => $value) {
            $buttonStyle[] = $name . ':' . $value;
        }

        return [
            'content' => $this->contentOptions,
            'outerHtmlOptions' => array_merge(
                $this->outerHtml,
                [
                    'style' => implode(';', $outerStyle),
                    'class' => $this->classOptions['classOuter'],
                ]
            ),
            'innerHtmlOptions' => array_merge(
                $this->innerHtml,
                [
                    'style' => implode(';', $innerStyle),
                    'class' => $this->classOptions['classInner'],
                ]
            ),
            'buttonHtmlOptions' => array_merge(
                $this->buttonHtml,
                [
                    'style' => implode(';', $buttonStyle),
                    'class' => $this->classOptions['classButton'],
                ]
            ),
            'params' => $this->params,
        ];
    }

    /**
     * Replaces the CSS styles for selected part.
     * @param int $what number of part
     * @param array $value list of styles
     */
    protected function replaceStyle($what, $value)
    {
        if (is_array($value)) {
            $type = 'inner';
            switch ($what) {
                case 0:
                    $type = 'outer';
                    break;
                case 2:
                    $type = 'button';
                    break;
            }
            foreach ($value as $name => $set) {
                if (isset($this->{$type . 'Style'}[$name])) {
                    if ($set === false || $set === null) {
                        unset($this->{$type . 'Style'}[$name]);
                    } elseif (is_string($set)) {
                        $this->{$type . 'Style'}[$name] = str_replace(';', '', trim($set));
                    }
                }
            }
        }
    }

    /**
     * Replaces the CSS styles for inner part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function replaceInnerStyle($value)
    {
        $this->replaceStyle(1, $value);
    }

    /**
     * Replaces the CSS styles for outer part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function replaceOuterStyle($value)
    {
        $this->replaceStyle(0, $value);
    }

    /**
     * Replaces the CSS styles for button part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function replaceButtonStyle($value)
    {
        $this->replaceStyle(2, $value);
    }

    /**
     * Runs the widget.
     * @return string
     */
    public function run()
    {
        $this->setMode();
        $this->checkBox();
        $this->checkCookie();
        $this->checkContent();
        $this->setDefaults();
        $this->initCookie();

        return $this->render(
            $this->mode === 'custom' ? $this->cookieView : 'box',
            $this->prepareViewParams()
        );
    }

    /**
     * Sets default values.
     */
    protected function setDefaults()
    {
        if (empty($this->contentOptions['category'])) {
            $this->contentOptions['category'] = 'app';
        }
        if (!array_key_exists('mainParams', $this->contentOptions)) {
            $this->contentOptions['mainParams'] = [];
        }
        if (!array_key_exists('buttonParams', $this->contentOptions)) {
            $this->contentOptions['buttonParams'] = [];
        }
        if (!array_key_exists('language', $this->contentOptions)) {
            $this->contentOptions['language'] = null;
        }
        if (!array_key_exists('mainMessage', $this->contentOptions)) {
            $this->contentOptions['mainMessage'] = 'We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.';
        }
        if (!array_key_exists('buttonMessage', $this->contentOptions)) {
            $this->contentOptions['buttonMessage'] = 'I understand';
        }
        if (!array_key_exists('path', $this->cookieOptions)) {
            $this->cookieOptions['path'] = '/';
        }
        if (!array_key_exists('expires', $this->cookieOptions)) {
            $this->cookieOptions['expires'] = 30;
        }
        if (!array_key_exists('secure', $this->cookieOptions)) {
            $this->cookieOptions['secure'] = false;
        }
        if (!array_key_exists('classOuter', $this->classOptions)) {
            $this->classOptions['classOuter'] = 'CookieMonsterBox';
        }
        if (!array_key_exists('classInner', $this->classOptions)) {
            $this->classOptions['classInner'] = '';
        }
        if (!array_key_exists('classButton', $this->classOptions)) {
            $this->classOptions['classButton'] = 'CookieMonsterOk';
        }
    }

    /**
     * Sets HTML options for selected part.
     * @param int $what number of part
     * @param array $value list of options
     */
    protected function setHtmlOptions($what, $value)
    {
        if (is_array($value)) {
            $type = 'inner';
            switch ($what) {
                case 0:
                    $type = 'outer';
                    break;
                case 2:
                    $type = 'button';
                    break;
            }
            foreach ($value as $name => $set) {
                if (is_string($set) && $name !== 'class' && $name !== 'style') {
                    $this->{$type . 'Html'}[$name] = trim($set);
                }
            }
        }
    }

    /**
     * Sets HTML options for inner part.
     * @param array $value list of options
     * @since 1.1
     */
    public function setInnerHtmlOptions($value)
    {
        $this->setHtmlOptions(1, $value);
    }

    /**
     * Sets HTML options for outer part.
     * @param array $value list of options
     * @since 1.1
     */
    public function setOuterHtmlOptions($value)
    {
        $this->setHtmlOptions(0, $value);
    }

    /**
     * Sets HTML options for button part.
     * @param array $value list of options
     * @since 1.1
     */
    public function setButtonHtmlOptions($value)
    {
        $this->setHtmlOptions(2, $value);
    }

    /**
     * Sets the mode with default CSS styles.
     */
    protected function setMode()
    {
        $this->outerStyle = [
            'display' => 'none',
            'z-index' => 10000,
            'position' => 'fixed',
            'background-color' => '#fff',
            'font-size' => '12px',
            'color' => '#000',
        ];
        $this->innerStyle = ['margin' => '10px'];
        $this->buttonStyle = ['margin-left' => '10px'];

        switch ($this->mode) {
            case 'bottom':
                $this->outerStyle = array_merge(
                    $this->outerStyle,
                    [
                        'bottom' => 0,
                        'left' => 0,
                        'width' => '100%',
                        'box-shadow' => '0 -2px 2px #000',
                    ]
                );
                break;
            case 'box':
                $this->outerStyle = array_merge(
                    $this->outerStyle,
                    [
                        'bottom' => '20px',
                        'right' => '20px',
                        'width' => '300px',
                        'box-shadow' => '-2px 2px 2px #000',
                        'border-radius' => '10px',
                    ]
                );
                break;
            case 'custom':
                $this->outerStyle = [];
                $this->innerStyle = [];
                $this->buttonStyle = [];
                break;
            default:
                $this->outerStyle = array_merge(
                    $this->outerStyle,
                    [
                        'top' => 0,
                        'left' => 0,
                        'width' => '100%',
                        'box-shadow' => '0 2px 2px #000',
                    ]
                );
        }
    }

    /**
     * Sets the CSS styles for selected part.
     * @param int $what number of part
     * @param array $value list of styles
     */
    protected function setStyle($what, $value)
    {
        if (is_array($value)) {
            $type = 'inner';
            switch ($what) {
                case 0:
                    $type = 'outer';
                    break;
                case 2:
                    $type = 'button';
                    break;
            }
            $tmp = [];
            foreach ($value as $name => $set) {
                if (!empty($set) && is_string($set)) {
                    $tmp[$name] = str_replace(';', '', trim($set));
                }
            }
            $this->{$type . 'Style'} = $tmp;
        }
    }

    /**
     * Sets the CSS styles for inner part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function setInnerStyle($value)
    {
        $this->setStyle(1, $value);
    }

    /**
     * Sets the CSS styles for outer part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function setOuterStyle($value)
    {
        $this->setStyle(0, $value);
    }

    /**
     * Sets the CSS styles for button part.
     * @param array $value list of styles
     * @since 1.1
     */
    public function setButtonStyle($value)
    {
        $this->setStyle(2, $value);
    }

    /**
     * Sets custom user's view path.
     * @param string $value view path
     * Since 1.1 this method is public.
     */
    public function setCookieView($value)
    {
        $value = trim($value);
        if (!empty($value)) {
            $this->cookieView = $value;
        }
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getButtonHtml()
    {
        return $this->buttonHtml;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getButtonStyle()
    {
        return $this->buttonStyle;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getClassOptions()
    {
        return $this->classOptions;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getContentOptions()
    {
        return $this->contentOptions;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getCookieOptions()
    {
        return $this->cookieOptions;
    }

    /**
     * @return string
     * @since 1.1
     */
    public function getCookieView()
    {
        return $this->cookieView;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getInnerHtml()
    {
        return $this->innerHtml;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getInnerStyle()
    {
        return $this->innerStyle;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getOuterHtml()
    {
        return $this->outerHtml;
    }

    /**
     * @return array
     * @since 1.1
     */
    public function getOuterStyle()
    {
        return $this->outerStyle;
    }
}
