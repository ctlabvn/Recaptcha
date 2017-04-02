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
     * @param bool $compactSize Show compact size recaptcha if true. Defaults to false.
     * @return string
     */
    public function display($compactSize = false)
    {
        $recaptcha = $this->config();
        if (!$recaptcha['enable']) {
            return '';
        }

        if ($compactSize == true) {
            $recaptchaSize = 'compact';
        } else {
            $recaptchaSize = 'normal'; // set recaptcha size as normal (default value)
        }

        return $this->_View->element('Recaptcha.recaptcha', compact('recaptcha'));
    }
}
