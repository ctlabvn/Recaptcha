<?php
namespace Recaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Recaptcha\ReCaptcha\ReCaptcha;
use Recaptcha\Validation\RecaptchaValidator;

/**
 * Recaptcha component
 */
class RecaptchaComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array default
     */
    protected $_defaultConfig = [
        'type' => 'image',
        'theme' => 'light'
    ];

    /**
     * @var ReCaptcha $recaptcha
     */
    private $recaptcha;

    /**
     * initialize
     * @param array $config config
     * @return void
     */
    public function initialize(array $config = [])
    {
        $errors = (new RecaptchaValidator())->errors(Configure::read('Recaptcha'));
        if (!empty($errors)) {
            throw new \Exception(__d('recaptcha', 'One of your recaptcha config value is incorrect'));
        }
        $this->_defaultConfig = array_merge($this->_defaultConfig, Configure::read('Recaptcha'));
        if ($this->_defaultConfig['enable']) {
            $this->recaptcha = new ReCaptcha($this->_defaultConfig['secret']);
        }
        $this->_registry->getController()->viewBuilder()->helpers(['Recaptcha.Recaptcha']);
    }

    /**
     * verify
     * @return bool
     */
    public function verify()
    {
        if (!$this->_defaultConfig['enable']) {
            return true;
        }
        $controller = $this->_registry->getController();
        if (isset($controller->request->data['g-recaptcha-response'])) {
            $resp = $this->recaptcha->verify($controller->request->data['g-recaptcha-response'], $controller->request->clientIp());
            return $resp->isSuccess();
        }
        return false;
    }
}
