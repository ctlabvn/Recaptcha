<?php
declare(strict_types=1);

namespace Recaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * Recaptcha helper
 */
class RecaptchaHelper extends Helper
{
    /**
     * initialize
     *
     * @param array $config config
     * @return void
     */
    public function initialize(array $config = []): void
    {
        $config += Configure::read('Recaptcha', []);
        $this->setConfig($config, merge: false);
    }

    /**
     * Display recaptcha function
     *
     * @return string
     */
    public function display(): string
    {
        $recaptcha = $this->getConfig();
        if (empty($recaptcha['enable'])) {
            return '';
        }

        return $this->_View->element('Recaptcha.recaptcha', compact('recaptcha'));
    }
}
