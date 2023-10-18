<?php
declare(strict_types=1);

namespace Recaptcha\View\Helper;

use Cake\View\Helper;

/**
 * Recaptcha helper
 */
class RecaptchaHelper extends Helper
{
    /**
     * Display recaptcha function
     *
     * @return string
     */
    public function display()
    {
        $recaptcha = $this->getConfig();
        if (!$recaptcha['enable']) {
            return '';
        }

        return $this->_View->element('Recaptcha.recaptcha', compact('recaptcha'));
    }
}
