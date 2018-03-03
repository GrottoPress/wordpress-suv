<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\Getter\GetterTrait;
use WP_Customize_Manager as WPCustomizer;

abstract class AbstractSection
{
    use GetterTrait;

    /**
     * @var AbstractCustomizer
     */
    protected $customizer;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var AbstractSetting[]
     */
    protected $settings = [];

    public function __construct(AbstractCustomizer $customizer)
    {
        $this->customizer = $customizer;
    }

    final protected function getCustomizer(): AbstractCustomizer
    {
        return $this->customizer;
    }

    protected function getID(): string
    {
        return $this->id;
    }

    /**
     * @return AbstractSetting[]
     */
    protected function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Be sure to set $this->settings here, in the child class.
     * Doing so in the constructor would be too early; it won't work.
     */
    public function add(WPCustomizer $WPCustomizer)
    {
        if (!$this->id) {
            return;
        }

        $WPCustomizer->add_section($this->id, $this->args);

        foreach ($this->settings as $setting) {
            $setting->add($WPCustomizer);
        }
    }

    public function remove(WPCustomizer $WPCustomizer)
    {
        if (!$this->id) {
            return;
        }

        $WPCustomizer->remove_section($this->id);
    }
}
