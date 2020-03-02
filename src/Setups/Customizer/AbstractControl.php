<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

Use GrottoPress\Getter\GetterTrait;
use WP_Customize_Manager as WPCustomizer;

abstract class AbstractControl
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
     * @var \WP_Customize_Control
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
     * Get control, if already added
     */
    public function get(WPCustomizer $wp_customizer)
    {
        return $wp_customizer->get_control($this->id);
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $wp_customizer->add_control(($this->object ?: $this->id), $this->args);
    }

    /**
     * Remove control, if already added
     */
    public function remove(WPCustomizer $wp_customizer)
    {
        $wp_customizer->remove_control($this->id);
    }
}
