<?php
namespace Recaptcha\View\Helper\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Recaptcha\View\Helper\RecaptchaHelper;

/**
 * Test case for RecaptchaHelper.
 */
class RecaptchaHelperTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->View = new View();
        $this->Recaptcha = new RecaptchaHelper(
            $this->View,
            [
                'enable' => true,
                'sitekey' => 'sitekey',
                'theme' => 'theme',
                'type' => 'type',
                'lang' => 'lang',
                'size' => 'size',
            ]
        );
    }

    public function testDisplay()
    {
        $result = $this->Recaptcha->display();
        $this->assertTrue(is_string($result));
        $this->assertContains('class="g-recaptcha"', $result);

        $this->Recaptcha->config('enable', false);
        $this->assertEmpty($this->Recaptcha->display());
    }
}
