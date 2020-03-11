<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Optionizer;

abstract class AbstractSubmenuPage extends AbstractPage
{
    /**
     * @var string
     */
    protected $parent;

    /**
     * @return string
     */
    protected function getParent(): string
    {
        return $this->parent;
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

        $this->hookSuffix = \add_submenu_page(
            $this->parent,
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
