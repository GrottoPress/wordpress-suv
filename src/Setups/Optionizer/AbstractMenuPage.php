<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Optionizer;

abstract class AbstractMenuPage extends AbstractPage
{
    /**
     * @var string
     */
    protected $iconUrl;

    /**
     * @return string
     */
    protected function getIconUrl(): string
    {
        return $this->iconUrl;
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

        $this->hookSuffix = \add_menu_page(
            $this->title,
            $this->label,
            $this->capability,
            $this->id,
            $this->callback,
            $this->iconUrl,
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
