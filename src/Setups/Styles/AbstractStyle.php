<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Styles;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractStyle extends AbstractSetup
{
    /**
     * @var string
     */
    protected $id;

    protected function getID(): string
    {
        return $this->id;
    }
}
