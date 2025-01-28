[![Build Status](https://img.shields.io/github/actions/workflow/status/ctlabvn/Recaptcha/ci.yml?branch=master)](https://github.com/ctlabvn/Recaptcha/actions?query=workflow%3ACI+branch%3Amaster)
[![Latest Stable Version](https://img.shields.io/packagist/v/crabstudio/recaptcha)](https://packagist.org/packages/crabstudio/recaptcha)
[![Total Downloads](https://img.shields.io/packagist/dt/crabstudio/recaptcha)](https://packagist.org/packages/crabstudio/recaptcha)
[![License](https://img.shields.io/github/license/ctlabvn/Recaptcha)](https://github.com/ctlabvn/Recaptcha/blob/master/LICENSE)

# Integrate Google Recaptcha v2 to your CakePHP project

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```bash
composer require crabstudio/recaptcha
```

## Load plugin

From command line:

```bash
bin/cake plugin load Recaptcha
```

## Load Component and Configure

Override default configure from loadComponent:

```php
$this->loadComponent('Recaptcha.Recaptcha', [
    'enable' => true,     // true/false
    'sitekey' => 'your_site_key', //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
    'secret' => 'your_secret',
    'type' => 'image',  // image/audio
    'theme' => 'light', // light/dark
    'lang' => 'vi',      // default en
    'size' => 'normal'  // normal/compact
]);
```

Override default configure from app config file:

```php
// file: config/app.php

    /**
     * Recaptcha configuration.
     *
     */
    'Recaptcha' => [
        'enable' => true,
        'sitekey' => 'your_site_key',
        'secret' => 'your_secret',
        'type' => 'image',
        'theme' => 'light',
        'lang' => 'es',
        'size' => 'normal'
    ]
```

Override default configure from recaptcha config file:

```php
// ffile: config/recaptcha.php

return [
    /**
     * Recaptcha configuration.
     *
     */
    'Recaptcha' => [
        'enable' => true,
        'sitekey' => 'your_site_key',
        'secret' => 'your_secret',
        'type' => 'image',
        'theme' => 'light',
        'lang' => 'es',
        'size' => 'normal'
    ]
];
```

Load recaptcha config file:

```php
// file: config/bootstrap.php

    Configure::load('recaptcha', 'default', true);
```

Config preference:
1. loadComponent config options
2. recaptcha config file
3. app config file

## Usage

Display recaptcha in your view:

```php
    <?= $this->Form->create() ?>
    <?= $this->Form->control('email') ?>
    // Display recaptcha box in your view, if configure has enable = false, nothing will be displayed
    <?= $this->Recaptcha->display() ?>
    <?= $this->Form->button() ?>
    <?= $this->Form->end() ?>
```

Verify in your controller function

```php
    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            if ($this->Recaptcha->verify()) { // if configure enable = false, it will always return true
                //do something here
            }
            $this->Flash->error(__('Please pass Google Recaptcha first'));
        }
    }
```

Done.
