<?php
namespace Recaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Network\Http\Client;
use Cake\I18n\I18n;

/**
 * Recaptcha component
 */
class RecaptchaComponent extends Component
{
    /**
     * Default config
     *
     * These are merged with user-provided config when the component is used.
     *
     * @var array
     */
    protected $_defaultConfig = [
        // This is test only key/secret
        'sitekey' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
        'secret' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
        'theme' => 'light',
        'type' => 'image',
        'enable' => true,
    ];

    /**
     * initialize
     * @param array $config config
     * @return void
     */
    public function initialize(array $config = [])
    {
        if (empty($config['lang'])) {
            array_push($config, ['lang' => I18n::locale()]);
        }
        $this->config($config);
        $this->_registry->getController()->viewBuilder()->helpers(['Recaptcha.Recaptcha' => ['config' => $this->_defaultConfig]]);
    }

    /**
     * verify recaptcha
     * @return bool
     */
    public function verify()
    {
        if (!$this->_defaultConfig['enable']) {
            return true;
        }
        $controller = $this->_registry->getController();
        if (isset($controller->request->data['g-recaptcha-response'])) {
            $response = (new Client())->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $this->_defaultConfig['secret'],
                'response' => $controller->request->data['g-recaptcha-response'],
                'remoteip' => $controller->request->clientIp()
            ]);

            return json_decode($response->body)->success;
        }
        return false;
    }
}
