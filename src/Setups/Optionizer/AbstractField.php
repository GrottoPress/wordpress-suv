<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Optionizer;

use GrottoPress\Getter\GetterTrait;

abstract class AbstractField
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
    protected $section = '';

    /**
     * @var array<string, mixed>
     */
    protected $args = [];

    /**
     * @var string
     */
    protected $capability = 'manage_options';

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

    protected function getSection(): string
    {
        return $this->section;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getArgs(): array
    {
        return $this->args;
    }

    protected function getCapability(): string
    {
        return $this->capability;
    }

    public function add()
    {
        if ($this->capability && !\current_user_can($this->capability)) {
            return;
        }

        \add_settings_field(
            $this->id,
            $this->label,
            $this->callback,
            $this->page,
            $this->section,
            $this->args
        );
    }
}
