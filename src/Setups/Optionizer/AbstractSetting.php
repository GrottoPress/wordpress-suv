<?php
declare (strict_types = 1);

namespace GrottoPress\SmartFeaturedImage\Setups\Optionizer;

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
     * @var mixed[string]
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
     * @return mixed[string]
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

        if (false === \get_option($this->id)) {
            \add_option($this->id);
        }

        \register_setting($this->group, $this->id, $this->args);
    }
}
