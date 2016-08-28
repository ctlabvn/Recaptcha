<?php
namespace Recaptcha\View\Helper;

use Cake\View\Helper;

/**
 * Recaptcha helper
 */
class RecaptchaHelper extends Helper
{
    /**
     * Constructor.
     *
     * @param array $config The settings for this helper.
     * @return void
     */
    public function initialize(array $config = [])
    {
        $this->config($config);
    }

    /**
     * Display recaptcha function
     * @return string
     */
    public function display()
    {
        $recaptcha = $this->config();
        if (!$recaptcha['enable']) {
            return false;
        }

        return <<<EOF
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl={$recaptcha['lang']}"></script>
<div class="g-recaptcha" data-sitekey="{$recaptcha['sitekey']}" data-theme="{$recaptcha['theme']}" data-type="{$recaptcha['type']}" async defer></div>
<noscript>
  <div>
    <div style="width: 302px; height: 422px; position: relative;">
      <div style="width: 302px; height: 422px; position: absolute;">
        <iframe src="https://www.google.com/recaptcha/api/fallback?k={$recaptcha['sitekey']}"
                frameborder="0" scrolling="no"
                style="width: 302px; height:422px; border-style: none;">
        </iframe>
      </div>
    </div>
    <div style="width: 300px; height: 60px; border-style: none;
                   bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
                   background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
      <textarea id="g-recaptcha-response" name="g-recaptcha-response"
                   class="g-recaptcha-response"
                   style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
                          margin: 10px 25px; padding: 0px; resize: none;" >
      </textarea>
    </div>
  </div>
</noscript>
EOF;
    }
}
