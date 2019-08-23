[![Build Status](https://travis-ci.org/agiletechvn/Recaptcha.svg?branch=master)](https://travis-ci.org/agiletechvn/Recaptcha) [![Latest Stable Version](https://poser.pugx.org/crabstudio/recaptcha/v/stable)](https://packagist.org/packages/crabstudio/recaptcha) [![Total Downloads](https://poser.pugx.org/crabstudio/recaptcha/downloads)](https://packagist.org/packages/crabstudio/recaptcha) [![License](https://poser.pugx.org/crabstudio/recaptcha/license)](https://packagist.org/packages/crabstudio/recaptcha)
# Integrate Google Recaptcha v2 to your CakePHP project

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require crabstudio/recaptcha
```

followed by the command:

```
composer update
```

## Load plugin

From command line:
```
bin/cake plugin load Recaptcha
```

## Load Component and Configure

Override default configure from loadComponent:
```
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
```file:config/app.php

    'Recaptcha' => [
        'enable' => true,
        'sitekey' => '6LcOm4sUAAAAAHIYSMWqQQMqB8RUn1D2LrPzj_Z2',
        'secret' => '6LcOm4sUAAAAACsbNFcznl3X72CzbOy6xve27Pzq',
        'type' => 'image',
        'theme' => 'light',
        'lang' => 'es',
        'size' => 'normal'
    ]
```

Override default configure from recaptcha config file:
```file:config/recaptcha.php
<?php

return [
    /**
     * Recaptcha configuration.
     *
     */
    'Recaptcha' => [
        'enable' => true,
        'sitekey' => '6LcOm4sUAAAAAHIYSMWqQQMqB8RUn1D2LrPzj_Z2',
        'secret' => '6LcOm4sUAAAAACsbNFcznl3X72CzbOy6xve27Pzq',
        'type' => 'image',
        'theme' => 'light',
        'lang' => 'es',
        'size' => 'normal'
    ]
];
```

Load recaptcha config file:
```file:config/bootstrap.php

    Configure::load('recaptcha', 'default', true);
```

Config preference:
1. loadComponent config options
2. recaptcha config file
3. app config file

## Usage

Display recaptcha in your view:
```
    <?= $this->Form->create() ?>
    <?= $this->Form->control('email') ?>
    <?= $this->Recaptcha->display() ?>  // Display recaptcha box in your view, if configure has enable = false, nothing will be displayed
    <?= $this->Form->button() ?>
    <?= $this->Form->end() ?>
```

Verify in your controller function
```
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

Done
