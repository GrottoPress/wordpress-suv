<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Sidebars;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\WordPress\SUV\IdentityTrait;

abstract class AbstractSidebar extends AbstractSetup
{
    use IdentityTrait;

    public function run()
    {
        \add_action('widgets_init', [$this, 'register']);
    }

    /**
     * Register/unregister widget area
     *
     * @action widgets_init
     */
    abstract public function register();
}
