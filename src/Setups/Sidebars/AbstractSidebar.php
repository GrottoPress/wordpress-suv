<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Sidebars;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractSidebar extends AbstractSetup
{
    /**
     * @var string
     */
    protected $id;

    protected function getID(): string
    {
        return $this->id;
    }

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
