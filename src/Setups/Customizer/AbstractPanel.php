<?php

/**
 * Abstract Panel
 *
 * @package GrottoPress\WordPress\SUV\Customizer
 * @since 0.1.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kus Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\Getter\Getter;
use WP_Customize_Manager as WPCustomizer;

/**
 * Abstract Panel
 *
 * @since 0.1.0
 */
abstract class AbstractPanel
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
     * Panel name
     *
     * @since 0.1.0
     * @access protected
     *
     * @var string
     */
    protected $name;

    /**
     * Panel args
     *
     * @since 0.1.0
     * @access protected
     *
     * @var array
     */
    protected $args = [];

    /**
     * Panel sections
     *
     * @since 0.1.0
     * @access protected
     *
     * @var AbstractSection[]
     */
    protected $sections = [];

    /**
     * Constructor
     *
     * @param AbstractCustomizer $customizer
     *
     * @since 0.1.0
     * @access protected
     */
    protected function __construct(AbstractCustomizer $customizer)
    {
        $this->customizer = $customizer;
    }

    /**
     * Get customizer
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
     * Get panel name
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
     * Get panel sections
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
     * Add Panel
     *
     * Be sure to set $this->sections HERE, in the child class.
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
        
        $WPCustomizer->add_panel($this->name, $this->args);

        foreach ($this->sections as $section) {
            $section->add($WPCustomizer);
        }
    }

    /**
     * Remove panel
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
        
        $WPCustomizer->remove_panel($this->name);
    }
}
