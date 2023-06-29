<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Optionizer;

use GrottoPress\Getter\GetterTrait;

abstract class AbstractSetting
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
    protected $group;

    /**
     * @var array<string, mixed>
     */
    protected $args;

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

    protected function getGroup(): string
    {
        return $this->group;
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

        \add_option($this->id);

        \register_setting($this->group, $this->id, $this->args);
    }
}
