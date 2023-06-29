<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\MetaBoxes;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractMetaBox extends AbstractSetup
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string $context 'normal', 'side', or 'advanced'.
     */
    protected $context;

    protected function getID(): string
    {
        return $this->id;
    }

    protected function getContext(): string
    {
        return $this->context;
    }
}
