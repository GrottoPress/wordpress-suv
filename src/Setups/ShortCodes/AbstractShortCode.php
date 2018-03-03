<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\ShortCodes;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractShortCode extends AbstractSetup
{
    /**
     * @var string
     */
    protected $id;

    protected function getID(): string
    {
        return $this->id;
    }

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
