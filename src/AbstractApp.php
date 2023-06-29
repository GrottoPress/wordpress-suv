<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV;

use Exception;
use GrottoPress\Getter\GetterTrait;
use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractApp
{
    use GetterTrait;

    /**
     * @static
     *
     * @var self[]
     */
    private static $instances = [];

    /**
     * @var array<string, AbstractSetup>
     */
    protected $setups = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception('Cannot unserialize singleton');
    }

    /**
     * @return array<string, AbstractSetup>
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

    final public static function getInstance()
    {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }

        return self::$instances[$class];
    }
}
