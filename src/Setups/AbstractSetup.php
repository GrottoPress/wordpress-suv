<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups;

use GrottoPress\WordPress\SUV\AbstractApp;
use GrottoPress\Getter\GetterTrait;

abstract class AbstractSetup
{
    use GetterTrait;

    /**
     * @var AbstractApp
     */
    protected $app;

    public function __construct(AbstractApp $app)
    {
        $this->app = $app;
    }

    final protected function getApp(): AbstractApp
    {
        return $this->app;
    }

    abstract public function run();
}
