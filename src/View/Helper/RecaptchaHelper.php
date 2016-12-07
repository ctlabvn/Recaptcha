<?php
namespace Recaptcha\View\Helper;

use Cake\View\Helper;

/**
 * Recaptcha helper
 */
class RecaptchaHelper extends Helper
{
    /**
     * Constructor.
     *
     * @param array $config The settings for this helper.
     * @return void
     */
    public function initialize(array $config = [])
    {
        $this->config($config);
    }

    /**
     * Display recaptcha function
     * @return string
     */
    public function display()
    {
        $recaptcha = $this->config();
        if (!$recaptcha['enable']) {
            return '';
        }

        return $this->_View->element('Recaptcha.recaptcha', compact('recaptcha'));
    }
}
