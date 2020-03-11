<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Thumbnails;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractThumbnail extends AbstractSetup
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
