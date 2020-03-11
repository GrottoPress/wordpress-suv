<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\PostTypeTemplates;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractTemplate extends AbstractSetup
{
    /**
     * @var string
     */
    protected $slug;

    protected function getSlug(): string
    {
        return $this->slug;
    }
}
