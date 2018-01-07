<?php

/**
 * Abstract Theme Mod
 *
 * @package GrottoPress\WordPress\SUV\Utilities\Mods
 * @since 0.1.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kus Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Utilities\Mods;

use GrottoPress\Getter\Getter;

/**
 * Abstract Theme Mod
 *
 * @since 0.1.0
 */
abstract class AbstractThemeMod
{
    use Getter;

    /**
     * Mod name
     *
     * @since 0.1.0
     * @access protected
     *
     * @var string
     */
    protected $name;

    /**
     * Default mod value
     *
     * @since 0.1.0
     * @access protected
     *
     * @var mixed
     */
    protected $default;

    /**
     * Get mod name
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
     * Get default mod
     *
     * @since 0.1.0
     * @access protected
     *
     * @return mixed
     */
    protected function getDefault()
    {
        return $this->default;
    }

    /**
     * Get mod
     *
     * @since 0.1.0
     * @access public
     *
     * @return mixed Mod.
     */
    public function get()
    {
        if (!$this->name) {
            \settype($null, \gettype($this->default));
            
            return $null;
        }

        return \get_theme_mod($this->name, $this->default);
    }
}
