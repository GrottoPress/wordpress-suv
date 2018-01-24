<?php

/**
 * Abstract Section
 *
 * @package GrottoPress\WordPress\SUV\Customizer
 * @since 0.1.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\Getter\Getter;
use WP_Customize_Manager as WPCustomizer;

/**
 * Abstract Section
 *
 * @since 0.1.0
 */
abstract class AbstractSection
{
    use Getter;

    /**
     * Customizer
     *
     * @since 0.1.0
     * @access protected
     *
     * @var AbstractCustomizer
     */
    protected $customizer;

    /**
     * Section name
     *
     * @since 0.1.0
     * @access protected
     *
     * @var string
     */
    protected $name;

    /**
     * Section args
     *
     * @since 0.1.0
     * @access protected
     *
     * @var array
     */
    protected $args = [];

    /**
     * Settings
     *
     * @since 0.1.0
     * @access protected
     *
     * @var AbstractSetting[]
     */
    protected $settings = [];

    /**
     * Constructor
     *
     * @param AbstractCustomizer $customizer
     *
     * @since 0.1.0
     * @access public
     */
    public function __construct(AbstractCustomizer $customizer)
    {
        $this->customizer = $customizer;
    }

    /**
     * Customizer
     *
     * @since 0.1.0
     * @access protected
     *
     * @return AbstractCustomizer
     */
    final protected function getCustomizer(): AbstractCustomizer
    {
        return $this->customizer;
    }

    /**
     * Get section name
     *
     * @since 0.1.0
     * @access protected
     *
     * @return string
     */
    protected function getName(): string
    {
        return $this->name;
    }

    /**
     * Get section settings
     *
     * @since 0.1.0
     * @access protected
     *
     * @return AbstractSetting[]
     */
    protected function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Add section
     *
     * Be sure to set $this->settings here, in the child class.
     * Doing that in the constructor would be too early; it won't work.
     *
     * @param WPCustomizer $WPCustomizer
     *
     * @since 0.1.0
     * @access public
     */
    public function add(WPCustomizer $WPCustomizer)
    {
        if (!$this->name) {
            return;
        }

        $WPCustomizer->add_section($this->name, $this->args);

        foreach ($this->settings as $setting) {
            $setting->add($WPCustomizer);
        }
    }

    /**
     * Remove section
     *
     * @param WPCustomizer $WPCustomizer
     *
     * @since 0.1.0
     * @access public
     */
    public function remove(WPCustomizer $WPCustomizer)
    {
        if (!$this->name) {
            return;
        }
        
        $WPCustomizer->remove_section($this->name);
    }
}
