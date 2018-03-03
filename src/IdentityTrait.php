<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV;

use GrottoPress\Getter\GetterTrait;

trait IdentityTrait
{
    use GetterTrait;

    /**
     * @var string
     */
    protected $id;

    protected function getID(): string
    {
        return $this->id;
    }
}
