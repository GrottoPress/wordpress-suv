<?php

/**
 * Abstract Customizer
 *
 * @package GrottoPress\WordPress\SUV\Customizer
 * @since 0.1.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use WP_Customize_Manager as WPCustomizer;

/**
 * Abstract Customizer
 *
 * @since 0.1.0
 */
abstract class AbstractCustomizer extends AbstractSetup
{
    /**
     * Panels
     *
     * @since 0.1.0
     * @access protected
     *
     * @var AbstractPanel[]
     */
    protected $panels = [];

    /**
     * Sections
     *
     * @since 0.1.0
     * @access protected
     *
     * @var AbstractSection[]
     */
    protected $sections = [];

    /**
     * Get panels
     *
     * Panels comprise sections which, in turn,
     * comprise settings.
     *
     * @since 0.1.0
     * @access protected
     *
     * @return AbstractPanel[]
     */
    protected function getPanels(): array
    {
        return $this->panels;
    }

    /**
     * Get sections
     *
     * Use this ONLY if sections come under no panel.
     * Each section comprises its settings.
     *
     * @since 0.1.0
     * @access protected
     *
     * @return AbstractSection[]
     */
    protected function getSections(): array
    {
        return $this->sections;
    }

    /**
     * Run setup
     *
     * @since 0.5.0
     * @access public
     */
    public function run()
    {
        \add_action('customize_register', [$this, 'register']);
    }

    /**
     * Register theme customizer
     *
     * Be sure to set $this->panels, $this->sections HERE, in the child class.
     * Doing that in the constructor would be too early; it won't work.
     *
     * @param WPCustomizer $WPCustomizer
     *
     * @action customize_register
     *
     * @since 0.1.0
     * @access public
     */
    public function register(WPCustomizer $WPCustomizer)
    {
        $this->addPanels($WPCustomizer);
        $this->addSections($WPCustomizer);
    }

    /**
     * Add panels
     *
     * @param WPCustomizer $WPCustomizer
     *
     * @since 0.1.0
     * @access protected
     */
    protected function addPanels(WPCustomizer $WPCustomizer)
    {
        foreach ($this->panels as $panel) {
            $panel->add($WPCustomizer);
        }
    }

    /**
     * Add sections
     *
     * @param WPCustomizer $WPCustomizer
     *
     * @since 0.1.0
     * @access protected
     */
    protected function addSections(WPCustomizer $WPCustomizer)
    {
        foreach ($this->sections as $section) {
            $section->add($WPCustomizer);
        }
    }
}
