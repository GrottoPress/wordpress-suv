<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Optionizer;

use GrottoPress\Getter\GetterTrait;

abstract class AbstractPage
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
    protected $title;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $capability = 'manage_options';

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var AbstractSection[string]
     */
    protected $sections = [];

    /**
     * @var string
     */
    protected $hookSuffix = '';

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

    protected function getTitle(): string
    {
        return $this->title;
    }

    protected function getLabel(): string
    {
        return $this->label;
    }

    protected function getCapability(): string
    {
        return $this->capability;
    }

    protected function getCallback(): callable
    {
        return $this->callback;
    }

    protected function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return AbstractSection[string]
     */
    protected function getSections(): array
    {
        return $this->sections;
    }

    protected function getHookSuffix(): string
    {
        return $this->hookSuffix;
    }

    /**
     * Be sure to set `$this->sections` HERE, in the child class.
     * Doing that in the constructor may be too early; it mighty not work.
     */
    public function add()
    {
        if (!$this->id) {
            return;
        }

        if ($this->capability && !\current_user_can($this->capability)) {
            return;
        }

        $this->hookSuffix = \add_options_page(
            $this->title,
            $this->label,
            $this->capability,
            $this->id,
            $this->callback,
            $this->position
        );

        \array_walk(
            $this->sections,
            function (AbstractSection $section, string $key) {
                $section->add();
            }
        );
    }
}
