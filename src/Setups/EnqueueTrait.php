<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups;

use GrottoPress\WordPress\SUV\IdentityTrait;

trait EnqueueTrait
{
    use IdentityTrait;

    public function run()
    {
        \add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    /**
     * Enqueue/dequeue script
     *
     * @action wp_enqueue_scripts
     */
    abstract public function enqueue();
}
