<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\WordPress\SUV\IdentityTrait;
use WP_Customize_Manager as WPCustomizer;

abstract class AbstractPanel
{
    use IdentityTrait;

    /**
     * @var AbstractCustomizer
     */
    protected $customizer;

    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var AbstractSection[]
     */
    protected $sections = [];

    protected function __construct(AbstractCustomizer $customizer)
    {
        $this->customizer = $customizer;
    }

    final protected function getCustomizer(): AbstractCustomizer
    {
        return $this->customizer;
    }

    /**
     * @return AbstractSection[]
     */
    protected function getSections(): array
    {
        return $this->sections;
    }

    /**
     * Be sure to set $this->sections HERE, in the child class.
     * Doing that in the constructor would be too early; it won't work.
     */
    public function add(WPCustomizer $WPCustomizer)
    {
        if (!$this->id) {
            return;
        }

        $WPCustomizer->add_panel($this->id, $this->args);

        foreach ($this->sections as $section) {
            $section->add($WPCustomizer);
        }
    }

    public function remove(WPCustomizer $WPCustomizer)
    {
        if (!$this->id) {
            return;
        }

        $WPCustomizer->remove_panel($this->id);
    }
}
