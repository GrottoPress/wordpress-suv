<?php

/**
 * Abstract Setting
 *
 * @package GrottoPress\WordPress\SUV\Customizer
 * @since 0.1.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\Getter\GetterTrait;
use WP_Customize_Manager as WPCustomizer;

/**
 * Abstract Setting
 *
 * @since 0.1.0
 */
abstract class AbstractSetting
{
    use GetterTrait;

    /**
     * Section
     *
     * @since 0.1.0
     * @access protected
     *
     * @var AbstractSection
     */
    protected $section;

    /**
     * Setting name
     *
     * @since 0.1.0
     * @access protected
     *
     * @var string
     */
    protected $name;

    /**
     * Setting args
     *
     * @since 0.1.0
     * @access protected
     *
     * @var array
     */
    protected $args = [];

    /**
     * Setting control
     *
     * @since 0.1.0
     * @access protected
     *
     * @var array
     */
    protected $control = [];

    /**
     * Constructor
     *
     * @param AbstractSection $section
     *
     * @since 0.1.0
     * @access protected
     */
    protected function __construct(AbstractSection $section)
    {
        $this->section = $section;
    }

    /**
     * Get setting name
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
     * Add setting
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

        $WPCustomizer->add_setting($this->name, $this->args);
        $WPCustomizer->add_control($this->name, $this->control);
    }

    /**
     * Remove setting
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
        
        $WPCustomizer->remove_setting($this->name);
        $WPCustomizer->remove_control($this->name);
    }
}
