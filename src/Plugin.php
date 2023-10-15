<?php
declare(strict_types=1);

namespace Recaptcha;

use Cake\Core\BasePlugin;

/**
 * Recaptcha plugin class
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Plugin extends BasePlugin
{
    /**
     * Do bootstrapping or not
     */
    protected bool $bootstrapEnabled = false;

    /**
     * Load routes or not
     */
    protected bool $routesEnabled = false;

    /**
     * Console middleware
     */
    protected bool $consoleEnabled = false;
}
