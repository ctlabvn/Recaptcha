<?php
return [
    'Recaptcha' => [
        'type'    => 'image', //available image/audio
        'theme'   => 'light', //available light/dark
        'lang'    => 'vi', //if not exist, plugin in will use your default locale
        'enable'  => true, //available true/false
        'sitekey' => 'your_site_key', //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
        'secret'  => 'your_secret',
    ],
];
