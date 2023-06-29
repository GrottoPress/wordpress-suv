<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Optionizer;

use GrottoPress\Getter\GetterTrait;

abstract class AbstractSection
{
    use GetterTrait;

    /**
     * @var AbstractOptionizer
     */
    protected $optionizer;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var string
     */
    protected $page;

    /**
     * @var string
     */
    protected $capability = 'manage_options';

    /**
     * @var array<string, AbstractSetting>
     */
    protected $settings = [];

    /**
     * @var array<string, AbstractField>
     */
    protected $fields = [];

    public function __construct(AbstractOptionizer $optionizer)
    {
        $this->optionizer = $optionizer;
    }

    protected function getOptionizer(): AbstractOptionizer
    {
        return $this->optionizer;
    }

    protected function getID(): string
    {
        return $this->id;
    }

    protected function getLabel(): string
    {
        return $this->label;
    }

    protected function getCallback(): callable
    {
        return $this->callback;
    }

    protected function getPage(): string
    {
        return $this->page;
    }

    protected function getCapability(): string
    {
        return $this->capability;
    }

    /**
     * @return array<string, AbstractSetting>
     */
    protected function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @return array<string, AbstractField>
     */
    protected function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Be sure to set `$this->settings`, `$this->fields` HERE,
     * in the child class. Doing that in the constructor may be too early;
     * it mighty not work.
     */
    public function add()
    {
        if (!$this->id) {
            return;
        }

        if ($this->capability && !\current_user_can($this->capability)) {
            return;
        }

        \add_settings_section(
            $this->id,
            $this->label,
            $this->callback,
            $this->page
        );

        \array_walk(
            $this->settings,
            function (AbstractSetting $setting, string $key) {
                $setting->add();
            }
        );

        \array_walk(
            $this->fields,
            function (AbstractField $field, string $key) {
                $field->add();
            }
        );
    }
}
