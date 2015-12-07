[![Latest Stable Version](https://poser.pugx.org/crabstudio/recaptcha/v/stable)](https://packagist.org/packages/crabstudio/recaptcha) [![Total Downloads](https://poser.pugx.org/crabstudio/recaptcha/downloads)](https://packagist.org/packages/crabstudio/recaptcha) [![Latest Unstable Version](https://poser.pugx.org/crabstudio/recaptcha/v/unstable)](https://packagist.org/packages/crabstudio/recaptcha) [![License](https://poser.pugx.org/crabstudio/recaptcha/license)](https://packagist.org/packages/crabstudio/recaptcha)
# CakePHP 3: Integrate Google Recaptcha v2

## Introduction

Integrate Google Recaptcha v2 to your CakePHP v3.x project

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

Add this line to **Your_project\config\bootstrap.php**
```
Plugin::load('Crabstudio/Recaptcha', ['bootstrap' => true]);
```

## Configure

Write to your configure:
```
$recaptcha = [
    'Recaptcha' => [
        'type' => 'image',  //available image/audio
        'theme' => 'light', //available light/dark
        'lang' => 'vi'      //if not exist, plugin in will use your default locale
        'enable' => '1'     //available 0/1 mean disabled/enabled
        'sitekey' => 'your_site_key', //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
        'secret' => 'your_secret',
    ]
];
Cake\Core\Configure::write($recaptcha);
```

## Load component

In your controller initialize function
```
// Example, i just use recaptcha for function forgotPassword
if($this->request->action === 'forgotPassword') {
    $this->loadComponent('Crabstudio/Recaptcha.Recaptcha');
}
```

## Usage

Display recaptcha in your view:
```
    <?= $this->Form->create()?>
    <?= $this->Form->input('email')?>
    <?= $this->Recaptcha->display()?>  // Display recaptcha box in your view, if configure enable = 0, nothing display here
    <?= $this->Form->submit()?>
    <?= $this->Form->end()?>
```

Verify in your controller function

```
    public function forgotPassword() {
        if($this->request->is('post')){
            if($this->Recaptcha->verify()) { // if configure enable = 0, always return true
                //do something here
            }
            $this->Flash->error(__('Please pass Google Recaptcha first'));
        }
    }
```

Done