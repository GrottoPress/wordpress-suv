<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\Getter\GetterTrait;
use WP_Customize_Manager as WPCustomizer;

abstract class AbstractSetting
{
    use GetterTrait;

    /**
     * @var AbstractSection
     */
    protected $section;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var array
     */
    protected $control = [];

    protected function __construct(AbstractSection $section)
    {
        $this->section = $section;
    }

    protected function getName(): string
    {
        return $this->name;
    }

    public function add(WPCustomizer $WPCustomizer)
    {
        if (!$this->name) {
            return;
        }

        $WPCustomizer->add_setting($this->name, $this->args);
        $WPCustomizer->add_control($this->name, $this->control);
    }

    public function remove(WPCustomizer $WPCustomizer)
    {
        if (!$this->name) {
            return;
        }

        $WPCustomizer->remove_setting($this->name);
        $WPCustomizer->remove_control($this->name);
    }
}
