<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\ShortCodes;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\WordPress\SUV\IdentityTrait;

abstract class AbstractShortCode extends AbstractSetup
{
    use IdentityTrait;

    public function run()
    {
        \add_action('init', [$this, 'add']);
    }

    /**
     * Add/remove shortcode
     *
     * @action init
     */
    abstract public function add();
}
