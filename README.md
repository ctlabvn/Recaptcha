[![Latest Stable Version](https://poser.pugx.org/crabstudio/recaptcha/v/stable)](https://packagist.org/packages/crabstudio/recaptcha) [![Total Downloads](https://poser.pugx.org/crabstudio/recaptcha/downloads)](https://packagist.org/packages/crabstudio/recaptcha) [![Latest Unstable Version](https://poser.pugx.org/crabstudio/recaptcha/v/unstable)](https://packagist.org/packages/crabstudio/recaptcha) [![License](https://poser.pugx.org/crabstudio/recaptcha/license)](https://packagist.org/packages/crabstudio/recaptcha)

Google reCAPTCHA for CakePHP 3
==============================

I just modify repository to fit my requirement:

- Enable/Disable: Support enable/disable verify recaptcha through configure `Recaptcha.enable = true/false`
- Language: if you do not set configure `Recaptcha.lang`, automatic use your `intl.default_locale` to set language
- Test mode: If you did not load configure Recaptcha, default test key will be use

Copyright (c) [2014-2015] [cake17]

## Plugin's Objective ##

This plugin adds functionalities to use the new Google reCAPTCHA in CakePHP
projects.
For now multiple widgets on a single page is not available.

## Requirements ##

- PHP >= 5.4.16
- [CakePHP 3.x](http://book.cakephp.org/3.0/en/index.html)
- Server under `localhost` name. Be aware that the widgets will not be displayed
  if you have a vhost named local.dev/dev/ for instance.

## Installation ##

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require crabstudio/recaptcha
```
Or add the following lines to your application's **composer.json**:

```
"require": {
    "crabstudio/recaptcha": "^1.1"
}
```
followed by the command:

```
composer update
```

## Usage of plugin ##

### 1. Load plugin

In your `config/bootstrap.php` file after step 1 above:

    Plugin::load('Crabstudio/Recaptcha', ['bootstrap' => true]);

### 2. Go to Google reCAPTCHA site

Go [here](https://www.google.com/recaptcha/intro/index.html) to create a pair
of keys for your website.

### 3. Create or use reCAPTCHA
By default, if you does not load Recaptcha config, this plugin will run in test mode (sitekey and secret just for test)

### 4. Sample configure

- sitekey: get it on google website
- secret: get it on google website
- theme: dark or light
- type: image or audio
- enable: true or false
- lang: if not set, your default locale will be used

```
    $config = [
        'Recaptcha' => [
            'sitekey' => 'your key',
            'secret' => 'your secret',
            'theme' => 'light',
            'type' => 'image',
            'enable' => '1'
        ]
    ];
    Configure::write($config);
```

If you don't have a key and a secret, this plugin will use test key as default.

When `Recaptcha.enable = false`, RecaptchaComponent always `return true` and pass verification, and RecaptchaHelper always `return false`

### 5. Then add the component in your controller where you need the reCAPTCHA.

For example:

    public function initialize() {
        parent::initialize();
        if ($this->request->action === 'contact') {
            $this->loadComponent('Crabstudio/Recaptcha.Recaptcha');
        }
    }

### 6. Add the following in your controller.

    public function contact() {
        if ($this->request->is('post')) {
            if ($this->Recaptcha->verify()) {
                if ($contact->execute($this->request->data)) {
                    $this->Flash->success(__('We will get back to you soon.'));
                    return $this->redirect($this->referer());
                } else {
                    $this->Flash->error(__('There was a problem submitting your form.'));
                }
            } else {
                $this->Flash->error(__('Please check your Recaptcha Box.'));
            }
        }
    }

### 7. No need to add the helper.

It will be added with the component.

### 8. Finally add `<?= $this->Recaptcha->display() ?>` in your view template inside the form.

For example:

    <?= $this->Form->create() ?>
    <?= $this->Recaptcha->display() ?>

    <?= $this->Form->input('name', [
      'label' => __('Your Name'),
      // 'default' => $this->request->query('name'); // in case you add the Prg Component
    ]) ?>
    <?= $this->Form->input('message', [
      'type' => 'textarea',
      // 'default' => $this->request->query('message'); // in case you add the Prg Component
      'label' => __('Your Message')
    ]) ?>

    <?= $this->Form->button(__('OK')) ?>
    <?= $this->Form->end() ?>

## What's inside?

**COMPONENT**

- RecaptchaComponent

**HELPERS**

- RecaptchaHelper (Automatically added when the RecaptchaComponent is added)

## Support & Contribution ##

For support and feature request, please contact [cake17] or me through Github issues

Please feel free to contribute to the plugin with new issues, requests, unit
tests and code fixes or new features. If you want to contribute some code,
create a feature branch, and send us your pull request.
Unit tests for new features and issues detected are mandatory to keep quality
high.

## License ##

Copyright (c) [2014-2015] [cake17]

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
