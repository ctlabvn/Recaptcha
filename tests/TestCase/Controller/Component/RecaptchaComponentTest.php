<?php
declare(strict_types=1);

namespace Recaptcha\View\Helper\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Http\ServerRequest as Request;
use Cake\TestSuite\TestCase;
use Recaptcha\Controller\Component\RecaptchaComponent;

/**
 * Test case for RecaptchaComponentTest.
 */
class RecaptchaComponentTest extends TestCase
{
    protected Controller $controller;
    protected RecaptchaComponent $Recaptcha;

    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new Controller(new Request());

        $this->Recaptcha = $this->getMockBuilder(RecaptchaComponent::class)
            ->onlyMethods(['apiCall'])
            ->setConstructorArgs([
                new ComponentRegistry($this->controller),
                [
                    'enable' => true,
                    'sitekey' => 'sitekey',
                    'theme' => 'theme',
                    'type' => 'type',
                ],
            ])
            ->getMock();
    }

    public function testInitialize()
    {
        $this->Recaptcha->initialize();
        $this->assertEquals('en', $this->Recaptcha->getConfig('lang'));

        $this->Recaptcha->setConfig('lang', 'ja');
        $this->Recaptcha->initialize();
        $this->assertEquals('ja', $this->Recaptcha->getConfig('lang'));
    }

    public function testBeforeRender(): void
    {
        $this->Recaptcha->beforeRender(new Event('Controller.beforeRender'));
        $helpers = $this->controller->viewBuilder()->getHelpers();
        $this->assertArrayHasKey('Recaptcha', $helpers);

        $this->assertArrayHasKey('sitekey', $helpers['Recaptcha']);
        $this->assertArrayNotHasKey('secret', $helpers['Recaptcha']);
    }

    public function testVerifyFalse(): void
    {
        $this->assertFalse($this->Recaptcha->verify());

        $this->controller->setRequest($this->controller->getRequest()->withData('g-recaptcha-response', 'foo'));

        $this->Recaptcha->expects($this->once())
            ->method('apiCall')
            ->willReturn('');

        $this->assertFalse($this->Recaptcha->verify());
    }

    public function testVerifyTrue(): void
    {
        $this->controller->setRequest($this->controller->getRequest()->withData('g-recaptcha-response', 'foo'));

        $this->Recaptcha->expects($this->once())
            ->method('apiCall')
            ->willReturn('{"success":true}');

        $this->assertTrue($this->Recaptcha->verify());

        $this->Recaptcha->setConfig('enable', false);
        $this->assertTrue($this->Recaptcha->verify());
    }
}
