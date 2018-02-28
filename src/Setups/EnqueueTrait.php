<?php

/**
 * Enqueue trait
 *
 * @package GrottoPress\WordPress\SUV\Setups
 * @since 0.3.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups;

/**
 * Enqueue trait
 *
 * @since 0.3.0
 */
trait EnqueueTrait
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
        \add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    /**
     * Enqueue/dequeue script
     *
     * @since 0.3.0
     * @access public
     *
     * @action wp_enqueue_scripts
     */
    abstract public function enqueue();
}
