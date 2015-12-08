<?php
namespace Crabstudio\Recaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Crabstudio\Recaptcha\ReCaptcha\ReCaptcha;
use Cake\Core\Configure;
use Crabstudio\Recaptcha\Validation\RecaptchaValidator;

/**
 * Recaptcha component
 */
class RecaptchaComponent extends Component
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

    private $recaptcha;

    public function initialize(array $config = [])
    {
        $errors = (new RecaptchaValidator())->errors(Configure::read('Recaptcha'));
        if(!empty($errors)) {
            throw new \Exception(__d('recaptcha', 'One of your recaptcha config value is incorrect'));
        }
        $this->_defaultConfig = array_merge($this->_defaultConfig, Configure::read('Recaptcha'));
        if($this->_defaultConfig['enable'] === '1') {
	        $this->recaptcha = new ReCaptcha($this->_defaultConfig['secret']);
        }
        $this->_registry->getController()->viewBuilder()->helpers(['Crabstudio/Recaptcha.Recaptcha']);
    }

    public function verify() {
        if(!$this->_defaultConfig['enable']) {
            return true;
        }
        $controller = $this->_registry->getController();
        if(isset($controller->request->data['g-recaptcha-response'])) {
            $resp = $this->recaptcha->verify($controller->request->data['g-recaptcha-response'], $controller->request->clientIp());
            return $resp->isSuccess();
        }
        return false;
    }
}
