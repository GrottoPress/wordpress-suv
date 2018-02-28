<?php

/**
 * Abstract Setup
 *
 * @package GrottoPress\WordPress\SUV\Setups
 * @since 0.1.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups;

use GrottoPress\WordPress\SUV\AbstractApp;
use GrottoPress\Getter\GetterTrait;

/**
 * Abstract Setup
 *
 * @since 0.1.0
 */
abstract class AbstractSetup
{
    use GetterTrait;

    /**
     * App
     *
     * @since 0.1.0
     * @access public
     *
     * @var AbstractApp
     */
    protected $app;

    /**
     * Constructor
     *
     * @param AbstractApp $app
     *
     * @since 0.1.0
     * @access public
     */
    public function __construct(AbstractApp $app)
    {
        $this->app = $app;
    }

    /**
     * Get app
     *
     * @since 0.1.0
     * @access protected
     *
     * @return AbstractApp
     */
    final protected function getApp(): AbstractApp
    {
        return $this->app;
    }

    /**
     * Run setup
     *
     * @since 0.1.0
     * @access public
     */
    abstract public function run();
}
