<?php
namespace Recaptcha\View\Helper\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Network\Request;
use Cake\TestSuite\TestCase;
use Recaptcha\Controller\Component\RecaptchaComponent;

/**
 * Test case for RecaptchaComponentTest.
 */
class RecaptchaComponentTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->controller = new Controller(new Request());

        $this->Recaptcha = $this->getMockBuilder(RecaptchaComponent::class)
            ->setMethods(['apiCall'])
            ->setConstructorArgs([
                new ComponentRegistry($this->controller),
                [
                    'enable' => true,
                    'sitekey' => 'sitekey',
                    'theme' => 'theme',
                    'type' => 'type',
                    'lang' => 'lang',
                ]
            ])
            ->getMock();
    }

    public function testVerifyFalse()
    {
        $this->assertFalse($this->Recaptcha->verify());

        $this->controller->request->data['g-recaptcha-response'] = 'foo';

        $this->Recaptcha->expects($this->once())
            ->method('apiCall')
            ->will($this->returnValue(null));

        $this->assertFalse($this->Recaptcha->verify());
    }

    public function testVerifyTrue()
    {
        $this->controller->request->data['g-recaptcha-response'] = 'foo';

        $this->Recaptcha->expects($this->once())
            ->method('apiCall')
            ->will($this->returnValue('{"success":true}'));

        $this->assertTrue($this->Recaptcha->verify());
    }
}
