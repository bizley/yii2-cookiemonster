# yii2-cookiemonster
Yii 2 extension to manage cookie warning

![Latest Stable Version](https://img.shields.io/packagist/v/bizley/cookiemonster.svg)
![Total Downloads](https://img.shields.io/packagist/dt/bizley/cookiemonster.svg)
![License](https://img.shields.io/packagist/l/bizley/cookiemonster.svg)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fbizley%2Fyii2-cookiemonster%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/bizley/yii2-cookiemonster/master)

## What is it for?
In 2009, the European Union sought new regulations as part of an "e-privacy" directive, seeing cookies as a potential 
threat to privacy, because users often don't know they are being tracked.  
This extension adds the information about cookies for the Yii website.

## Requirements
Yii 2

## Installation
Get it through composer by adding the package to your composer.json:

```php
{
    "require": {
        "bizley/cookiemonster": "*"
    }
}
```

Or run `composer require bizley/cookiemonster`.


## Usage
Add this code in your main template file just before `<?php $this->endBody() ?>`

    <?= \bizley\cookiemonster\CookieMonster::widget() ?>
    
This will render widget with all default options (and 'top' layout).  
If you want to configure it add options array.

    <?= \bizley\cookiemonster\CookieMonster::widget([/* options here */]) ?>

All options (and options' options) are described below.  
For example if you want to use custom message on the button and use 'bottom' layout set:

    <?= \bizley\cookiemonster\CookieMonster::widget([
        'content' => [
            'buttonMessage' => 'OK', // instead of default 'I understand'
        ],
        'mode' => 'bottom'
    ]); ?>

## Configuration
You can set widget options by passing array to the widget() method with the following keys:

* `box` - __array__ CSS class and styles and HTML options for div
* `content` - __array__ warning and button message
* `cookie` - __array__ cookie options
* `mode` - __string__ widget layout selection
* `params` - __mixed__ user's parameters to pass to the custom widget layout

## `box` options
* `addButtonStyle` - __array__ list of button CSS style options to be added or replaced with new values 
  i.e. 'padding-right' => '20px', 'font-weight' => 'bold'
* `addInnerStyle` - __array__ list of inner div CSS style options to be added or replaced with new values
* `addOuterStyle` - __array__ list of outer div CSS style options to be added or replaced with new values
* `buttonHtmlOptions` - __array__ list of button HTML options to be added (except style and class)
* `classButton` - __string__ button class or classes (separated by spaces), default 'CookieMonsterOk'
* `classInner` - __string__ inner div class or classes (separated by spaces)
* `classOuter` - __string__ outer div class or classes (separated by spaces), default 'CookieMonsterBox'
* `innerHtmlOptions` - __array__ list of inner div HTML options to be added (except style and class)
* `outerHtmlOptions` - __array__ list of outer div HTML options to be added (except style and class)
* `replaceButtonStyle` - __array__ list of button CSS style options to be replaced with new values or removed 
  i.e. 'margin-left' => '10px', 'font-size' => false
* `replaceInnerStyle` - __array__ list of inner div CSS style options to be replaced with new values or removed
* `replaceOuterStyle` - __array__ list of outer div CSS style options to be replaced with new values or removed
* `setButtonStyle` - __array__ list of button CSS style options to be set replacing the default ones
* `setInnerStyle` - __array__ list of inner div CSS style options to be set replacing the default ones
* `setOuterStyle` - __array__ list of outer div CSS style options to be set replacing the default ones
* `view` - __string__ path to the custom view (required if $mode is set to 'custom'), for views outside the widget 
  folder use alias path i.e. '@app/views/cookie'

## `content` options
* `buttonMessage` - __string__ button original message as in Yii::t() $message, default 'I understand'
* `buttonParams` - __array__ parameters to be applied to the buttonMessage as in Yii::t() $params, default array()
* `category` - __string__ message category as in Yii::t() $category, default 'app'
* `language` - __string__ target language as in Yii::t() $language, default null
* `mainMessage` - __string__ main original message as in Yii::t() $message, default 'We use cookies on our websites to 
  help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of 
  cookies. Alternatively, you can manage them in your browser settings.'
* `mainParams` - __array__ parameters to be applied to the mainMessage as in Yii::t() $params, default array()

## `cookie` options
* `domain` - __string__ domain name for the cookie, default host portion of the current document location
* `expires` - __integer__ number of days this cookie will be valid for, default 30
* `max-age` - __integer__ max cookie age in seconds
* `path` - __string__ path for the cookie, default '/'
* `secure` - __boolean__ whether cookie should be transmitted over secure protocol as https, default false
* `sameSite` - __string__ 'lax' (default), 'strict', or 'none'

## `mode` possible values
* `bottom` - bottom strip
* `box` - bottom right box
* `custom` - custom mode defined by user (requires `box[view]` to be set)
* `top` - top strip, default

## Default layouts

### bottom

```html
<div style="display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;bottom:0;left:0;width:100%;box-shadow:0 -2px 2px #000" class="CookieMonsterBox">
    <div style="margin:10px" class="">
        We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.<button style="margin-left:10px" class="CookieMonsterOk" type="button">I understand</button>
    </div>
</div>
```

### box

```html
<div style="display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;bottom:20px;right:20px;width:300px;box-shadow:-2px 2px 2px #000;border-radius:10px" class="CookieMonsterBox">
    <div style="margin:10px" class="">
        We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.<button style="margin-left:10px" class="CookieMonsterOk" type="button">I understand</button>
    </div>
</div>
```

### top

```html
<div style="display:none;z-index:10000;position:fixed;background-color:#fff;font-size:12px;color:#000;top:0;left:0;width:100%;box-shadow:0 2px 2px #000" class="CookieMonsterBox">
    <div style="margin:10px" class="">
        We use cookies on our websites to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies. Alternatively, you can manage them in your browser settings.<button style="margin-left:10px" class="CookieMonsterOk" type="button">I understand</button>
    </div>
</div>
```

## Yii 1.1 version
You can find Yii 1.1 version at https://github.com/bizley/Yii-CookieMonster
