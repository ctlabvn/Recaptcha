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
        $this->setConfig($config);
    }

    /**
     * Display recaptcha function
     * @return string
     */
    public function display($xtraAttribs = null)
    {
        $recaptcha = $this->getConfig();
        if (!$recaptcha['enable']) {
            return '';
        }

        if (!empty($xtraAttribs)) {
            $recaptcha = array_merge($recaptcha, $xtraAttribs);
        }
        
        return $this->_View->element('Recaptcha.recaptcha', compact('recaptcha'));
    }
}
