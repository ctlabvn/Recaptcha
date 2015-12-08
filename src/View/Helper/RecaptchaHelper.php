<?php
namespace Crabstudio\Recaptcha\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\I18n\I18n;
use Cake\Core\Configure;
use Crabstudio\Recaptcha\Validation\RecaptchaValidator;

/**
 * Recaptcha helper
 */
class RecaptchaHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'type' => 'image',
        'theme' => 'light'
    ];

    public function __construct(View $view, array $config = []) {
        parent::__construct($view, $config);

        $errors = (new RecaptchaValidator())->errors(Configure::read('Recaptcha'));
        if(!empty($errors)) {
            throw new \Exception(__d('recaptcha', 'One of your recaptcha config value is incorrect'));
        }
        $this->_defaultConfig = array_merge($this->_defaultConfig, Configure::read('Recaptcha'));
        if (!isset($this->_defaultConfig['lang']) || empty($this->_defaultConfig['lang'])) {
            $this->_defaultConfig['lang'] = I18n::locale();
        }
    }

    public function display() {
        if($this->_defaultConfig['enable'] === '0') {
            return '';
        }
        extract($this->_defaultConfig);
        return <<<recaptcha
            <div class="g-recaptcha" data-sitekey="$sitekey" data-theme="$theme" data-type="$type"></div>
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=$lang"></script>
recaptcha;
    }
}
