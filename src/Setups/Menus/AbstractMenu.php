<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Menus;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\WordPress\SUV\IdentityTrait;

abstract class AbstractMenu extends AbstractSetup
{
    use IdentityTrait;

    public function run()
    {
        \add_action('after_setup_theme', [$this, 'register']);
    }

    /**
     * Register/unregister menu
     *
     * @action after_setup_theme
     */
    abstract public function register();
}
