<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

Use GrottoPress\Getter\GetterTrait;
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
     * @var \WP_Customize_Section
     */
    protected $object;

    /**
     * @var array<string, mixed>
     */
    protected $args = [];

    /**
     * @var array<string, AbstractSetting>
     */
    protected $settings = [];

    /**
     * @var array<string, AbstractControl>
     */
    protected $controls = [];

    public function __construct(AbstractCustomizer $customizer)
    {
        $this->customizer = $customizer;
    }

    protected function getCustomizer(): AbstractCustomizer
    {
        return $this->customizer;
    }

    protected function getID(): string
    {
        return $this->id;
    }

    /**
     * @return array<string, AbstractSetting>
     */
    protected function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @return array<string, AbstractControl>
     */
    protected function getControls(): array
    {
        return $this->controls;
    }

    /**
     * Get section, if already added
     */
    public function get(WPCustomizer $wp_customizer)
    {
        return $wp_customizer->get_section($this->id);
    }

    /**
     * Be sure to set `$this->settings`, `$this->controls`, here,
     * in the child class. Doing so in the constructor may be too early;
     * it mighty not work.
     */
    public function add(WPCustomizer $wp_customizer)
    {
        if (!$this->id && !$this->object) {
            return;
        }

        $wp_customizer->add_section(($this->object ?: $this->id), $this->args);

        \array_walk(
            $this->settings,
            function (
                AbstractSetting $setting,
                string $key
            ) use ($wp_customizer) {
                $setting->add($wp_customizer);
            }
        );

        \array_walk(
            $this->controls,
            function (
                AbstractControl $control,
                string $key
            ) use ($wp_customizer) {
                $control->add($wp_customizer);
            }
        );
    }

    /**
     * Remove section, if already added
     */
    public function remove(WPCustomizer $wp_customizer)
    {
        $wp_customizer->remove_section($this->id);
    }
}
