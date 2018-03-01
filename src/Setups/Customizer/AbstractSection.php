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
    protected $name;

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

    protected function getName(): string
    {
        return $this->name;
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
        if (!$this->name) {
            return;
        }

        $WPCustomizer->add_section($this->name, $this->args);

        foreach ($this->settings as $setting) {
            $setting->add($WPCustomizer);
        }
    }

    public function remove(WPCustomizer $WPCustomizer)
    {
        if (!$this->name) {
            return;
        }
        
        $WPCustomizer->remove_section($this->name);
    }
}
