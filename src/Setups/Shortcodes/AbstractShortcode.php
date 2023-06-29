<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Shortcodes;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractShortcode extends AbstractSetup
{
    /**
     * @var string
     */
    protected $tag;

    protected function getTag(): string
    {
        return $this->tag;
    }
}
