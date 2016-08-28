[![Build Status](https://travis-ci.org/crabstudio/Recaptcha.svg?branch=master)](https://travis-ci.org/crabstudio/Recaptcha) [![Latest Stable Version](https://poser.pugx.org/crabstudio/recaptcha/v/stable)](https://packagist.org/packages/crabstudio/recaptcha) [![Total Downloads](https://poser.pugx.org/crabstudio/recaptcha/downloads)](https://packagist.org/packages/crabstudio/recaptcha) [![Latest Unstable Version](https://poser.pugx.org/crabstudio/recaptcha/v/unstable)](https://packagist.org/packages/crabstudio/recaptcha) [![License](https://poser.pugx.org/crabstudio/recaptcha/license)](https://packagist.org/packages/crabstudio/recaptcha)
# CakePHP 3: Integrate Google Recaptcha v2

## Introduction

Integrate Google Recaptcha v2 to your CakePHP v3.x project

## Donate

Buy me a cup of coffee [![paypal](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anhtuank7c%40hotmail%2ecom&lc=US&item_name=Crabstudio%20CakePHP%203%20%2d%20FlatAdmin%20Skeleton&item_number=crabstudio%2dcakephp%2dskeleton&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest)

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require crabstudio/recaptcha
```
Or add the following lines to your application's **composer.json**:

```
"require": {
    "crabstudio/recaptcha": "^1.0"
}
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

Or this line to the end of **Your_project\config\bootstrap.php**
```
Plugin::load('Recaptcha', ['bootstrap' => true]);
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
]);
```

## Usage

Display recaptcha in your view:
```
    <?= $this->Form->create()?>
    <?= $this->Form->input('email')?>
    <?= $this->Recaptcha->display()?>  // Display recaptcha box in your view, if configure enable = false, nothing to display here
    <?= $this->Form->submit()?>
    <?= $this->Form->end()?>
```

Verify in your controller function
```
    public function forgotPassword() {
        if($this->request->is('post')){
            if($this->Recaptcha->verify()) { // if configure enable = false, always return true
                //do something here
            }
            $this->Flash->error(__('Please pass Google Recaptcha first'));
        }
    }
```

Done