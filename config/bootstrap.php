<?php

/**
 * Bootstrap
 *
 * @author   anhtuank7c
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://crabstudio.info/
 */
use Cake\Core\Configure;
use Cake\I18n\I18n;

// if your app did not load config, the defaut test key will be used
if (!Configure::check('Recaptcha')) {
    $config = [
        'Recaptcha' => [
            'sitekey' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
            'secret' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
            'theme' => 'light',
            'type' => 'image',
            'enable' => true
        ]
    ];
    Configure::write($config);
}
if (!Configure::check('Recaptcha.lang')) {
    Configure::write('Recaptcha.lang', I18n::locale());
}
