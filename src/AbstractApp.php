<?php

/**
 * Abstract App
 *
 * @package GrottoPress\WordPress\SUV
 * @since 0.1.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV;

use GrottoPress\Getter\GetterTrait;
use FlorianWolters\Component\Util\Singleton\SingletonTrait;

/**
 * Abstract App
 *
 * @since 0.1.0
 */
abstract class AbstractApp
{
    use SingletonTrait, GetterTrait;

    /**
     * App setups
     *
     * @since 0.1.0
     * @access protected
     *
     * @var Setups\AbstractSetup[]
     */
    protected $setups = [];

    /**
     * Constructor
     *
     * @since 0.1.0
     * @access protected
     */
    protected function __construct()
    {
    }

    /**
     * Get setups
     *
     * @since 0.1.0
     * @access protected
     *
     * @return Setups\AbstractSetup[]
     */
    protected function getSetups(): array
    {
        return $this->setups;
    }

    /**
     * Run app
     *
     * @since 0.1.0
     * @access public
     */
    public function run()
    {
        foreach ($this->setups as $setup) {
            $setup->run();
        }
    }
}
