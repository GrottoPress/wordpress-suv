<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV;

abstract class AbstractChildTheme extends AbstractTheme
{
    /**
     * @var AbstractTheme
     */
    protected $parent;

    abstract protected function getParent(): AbstractTheme;
}
