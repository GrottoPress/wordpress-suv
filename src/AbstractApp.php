<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV;

use GrottoPress\Getter\GetterTrait;
use FlorianWolters\Component\Util\Singleton\SingletonTrait;

abstract class AbstractApp
{
    use SingletonTrait, GetterTrait;

    /**
     * @var Setups\AbstractSetup[int]
     */
    protected $setups = [];

    protected function __construct()
    {
    }

    /**
     * @return Setups\AbstractSetup[int]
     */
    protected function getSetups(): array
    {
        return $this->setups;
    }

    public function run()
    {
        foreach ($this->setups as $setup) {
            $setup->run();
        }
    }
}
