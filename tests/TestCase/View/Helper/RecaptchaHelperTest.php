<?php
declare(strict_types=1);

namespace Recaptcha\View\Helper\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Recaptcha\View\Helper\RecaptchaHelper;

/**
 * Test case for RecaptchaHelper.
 */
class RecaptchaHelperTest extends TestCase
{
    protected View $View;
    protected RecaptchaHelper $Recaptcha;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadPlugins(['Recaptcha']);

        $this->View = new View();
        $this->Recaptcha = new RecaptchaHelper(
            $this->View,
            [
                'sitekey' => 'sitekey',
                'theme' => 'theme',
                'type' => 'type',
                'lang' => 'lang',
                'size' => 'size',
                'callback' => 'callback',
            ]
        );
    }

    public function testDisplay(): void
    {
        $result = $this->Recaptcha->display();
        $this->assertStringContainsString('class="g-recaptcha"', $result);
        $this->assertStringContainsString('data-sitekey="sitekey"', $result);
        $this->assertStringContainsString('data-theme="theme"', $result);
        $this->assertStringContainsString('data-type="type"', $result);
        $this->assertStringContainsString('data-size="size"', $result);
        $this->assertStringContainsString('data-callback="callback"', $result);

        $this->Recaptcha->setConfig('enable', false);
        $this->assertEmpty($this->Recaptcha->display());
    }
}
