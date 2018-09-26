<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\Getter\GetterTrait;
use FlorianWolters\Component\Util\Singleton\SingletonTrait;

abstract class AbstractApp
{
    use GetterTrait;
    use SingletonTrait;

    /**
     * @var AbstractSetup[string]
     */
    protected $setups = [];

    protected function __construct()
    {
    }

    /**
     * @return AbstractSetup[string]
     */
    protected function getSetups(): array
    {
        return $this->setups;
    }

    public function run()
    {
        \array_walk(
            $this->setups,
            function (AbstractSetup $setup, string $key) {
                $setup->run();
            }
        );
    }
}
