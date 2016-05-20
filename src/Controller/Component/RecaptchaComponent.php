<?php
namespace Recaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Network\Http\Client;

/**
 * Recaptcha component
 */
class RecaptchaComponent extends Component
{
    /**
     * initialize
     * @param array $config config
     * @return void
     */
    public function initialize(array $config = [])
    {
        $this->_registry->getController()->viewBuilder()->helpers(['Recaptcha.Recaptcha']);
    }

    /**
     * verify recaptcha
     * @return bool
     */
    public function verify()
    {
        if (!Configure::readOrFail('Recaptcha.enable')) {
            return true;
        }
        $controller = $this->_registry->getController();
        if (isset($controller->request->data['g-recaptcha-response'])) {
            $response = (new Client())->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => Configure::readOrFail('Recaptcha.secret'),
                'response' => $controller->request->data['g-recaptcha-response'],
                'remoteip' => $controller->request->clientIp()
            ]);
            return json_decode($response->body)->success;
        }
        return false;
    }
}
