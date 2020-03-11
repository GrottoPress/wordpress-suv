<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

Use GrottoPress\Getter\GetterTrait;
use WP_Customize_Manager as WPCustomizer;

abstract class AbstractSetting
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
     * @var \WP_Customize_Setting
     */
    protected $object;

    /**
     * @var mixed[string]
     */
    protected $args = [];

    public function __construct(AbstractCustomizer $customizer)
    {
        $this->customizer = $customizer;
    }

    protected function getID(): string
    {
        return $this->id;
    }

    /**
     * Get setting, if already added
     */
    public function get(WPCustomizer $wp_customizer)
    {
        return $wp_customizer->get_setting($this->id);
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $wp_customizer->add_setting(($this->object ?: $this->id), $this->args);
    }

    /**
     * Remove setting, if already added
     */
    public function remove(WPCustomizer $wp_customizer)
    {
        $wp_customizer->remove_setting($this->id);
    }
}
