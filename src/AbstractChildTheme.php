<?php

/**
 * Abstract Child Theme
 *
 * @package GrottoPress\WordPress\SUV
 * @since 0.2.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kus Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV;

/**
 * Abstract Child Theme
 *
 * @since 0.2.0
 */
abstract class AbstractChildTheme extends AbstractTheme
{
    /**
     * Parent theme
     *
     * @since 0.2.0
     * @access protected
     *
     * @var AbstractTheme
     */
    protected $parent;

    /**
     * Get parent theme
     *
     * @since 0.2.0
     * @access protected
     *
     * @return AbstractTheme
     */
    abstract protected function getParent(): AbstractTheme;
}
