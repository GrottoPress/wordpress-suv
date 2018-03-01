<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Menus;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractMenu extends AbstractSetup
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
        \add_action('after_setup_theme', [$this, 'register']);
    }

    /**
     * Register/unregister menu
     *
     * @action after_setup_theme
     */
    abstract public function register();
}
