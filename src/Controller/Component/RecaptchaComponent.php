<?php
namespace Recaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\I18n;
use Cake\Network\Http\Client;

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
        'lang' => 'en',
        'size' => 'normal',
        'httpClientOptions' => [],
    ];

    /**
     * initialize
     * @param array $config config
     * @return void
     */
    public function initialize(array $config = [])
    {
        $this->config($config);
        $this->_registry->getController()->viewBuilder()->helpers(['Recaptcha.Recaptcha' => $this->_config]);
    }

    /**
     * verify recaptcha
     * @return bool
     */
    public function verify()
    {
        if (!$this->_config['enable']) {
            return true;
        }

        $controller = $this->_registry->getController();
        if (isset($controller->request->data['g-recaptcha-response'])) {
            $response = json_decode($this->apiCall());

            if (isset($response->success)) {
                return $response->success;
            }
        }

        return false;
    }

    /**
     * Call reCAPTCHA API to verify
     *
     * @return string
     * @codeCoverageIgnore
     */
    protected function apiCall()
    {
        $controller = $this->_registry->getController();
        $client = new Client($this->_config['httpClientOptions']);

        return $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $this->_config['secret'],
            'response' => $controller->request->data['g-recaptcha-response'],
            'remoteip' => $controller->request->clientIp()
        ])->getBody();
    }
}
