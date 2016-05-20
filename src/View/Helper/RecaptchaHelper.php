<?php
namespace Recaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\I18n\I18n;
use Cake\View\Helper;
use Cake\View\View;
use Recaptcha\Validation\RecaptchaValidator;

/**
 * Recaptcha helper
 */
class RecaptchaHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @param array default config
     */
    protected $_defaultConfig = [
        'type' => 'image',
        'theme' => 'light'
    ];

    /**
     * __construct function
     *
     * @param Cake\View\View $view View
     * @param array $config config
     */
    public function __construct(View $view, array $config = [])
    {
        parent::__construct($view, $config);

        $errors = (new RecaptchaValidator())->errors(Configure::read('Recaptcha'));
        if (!empty($errors)) {
            throw new \Exception(__d('recaptcha', 'One of your recaptcha config value is incorrect'));
        }
        $this->_defaultConfig = array_merge($this->_defaultConfig, Configure::read('Recaptcha'));
        if (!isset($this->_defaultConfig['lang']) || empty($this->_defaultConfig['lang'])) {
            $this->_defaultConfig['lang'] = I18n::locale();
        }
    }

    /**
     * Display recaptcha function
     * @return string
     */
    public function display()
    {
        if (!$this->_defaultConfig['enable']) {
            return '';
        }
        extract($this->_defaultConfig);
        return <<<recaptcha
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=$lang"></script>
            <div class="g-recaptcha" data-sitekey="$sitekey" data-theme="$theme" data-type="$type" async defer></div>
<noscript>
  <div>
    <div style="width: 302px; height: 422px; position: relative;">
      <div style="width: 302px; height: 422px; position: absolute;">
        <iframe src="https://www.google.com/recaptcha/api/fallback?k=$sitekey"
                frameborder="0" scrolling="no"
                style="width: 302px; height:422px; border-style: none;">
        </iframe>
      </div>
    </div>
    <div style="width: 300px; height: 60px; border-style: none;
                   bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
                   background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
      <textarea id="g-recaptcha-response" name="g-recaptcha-response"
                   class="g-recaptcha-response"
                   style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
                          margin: 10px 25px; padding: 0px; resize: none;" >
      </textarea>
    </div>
  </div>
</noscript>
recaptcha;
    }
}
