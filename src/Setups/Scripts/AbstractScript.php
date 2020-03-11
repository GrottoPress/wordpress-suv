<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Scripts;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractScript extends AbstractSetup
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
