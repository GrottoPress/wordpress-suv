<?php

/**
 * Abstract Menu
 *
 * @package GrottoPress\WordPress\SUV\Setups\Menus
 * @since 0.3.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Menus;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

/**
 * Abstract menu
 *
 * @since 0.3.0
 */
abstract class AbstractMenu extends AbstractSetup
{
    /**
     * ID
     *
     * @since 0.3.0
     * @access protected
     *
     * @var string
     */
    protected $id;

    /**
     * Get ID
     *
     * @since 0.3.0
     * @access protected
     */
    protected function getID(): string
    {
        return $this->id;
    }

    /**
     * Run setup
     *
     * @since 0.3.0
     * @access public
     */
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'register']);
    }

    /**
     * Register/unregister menu
     *
     * @since 0.3.0
     * @access public
     *
     * @action after_setup_theme
     */
    abstract public function register();
}
