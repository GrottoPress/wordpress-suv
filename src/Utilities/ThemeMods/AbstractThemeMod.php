<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Utilities\ThemeMods;

use GrottoPress\Getter\GetterTrait;

abstract class AbstractThemeMod
{
    use GetterTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var mixed
     */
    protected $default;

    protected function getID(): string
    {
        return $this->id;
    }

    protected function getDefault()
    {
        return $this->default;
    }

    public function get()
    {
        if (!$this->id) {
            \settype($null, \gettype($this->default));

            return $null;
        }

        return \get_theme_mod($this->id, $this->default);
    }

    public function update($newValue): bool
    {
        if (!$this->id) {
            return false;
        }

        return \set_theme_mod($this->id, $newValue);
    }

    public function delete()
    {
        if (!$this->id) {
            return;
        }

        \remove_theme_mod($this->id);
    }
}
