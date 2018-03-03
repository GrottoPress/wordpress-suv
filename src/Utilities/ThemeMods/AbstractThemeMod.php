<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Utilities\ThemeMods;

use GrottoPress\WordPress\SUV\IdentityTrait;

abstract class AbstractThemeMod
{
    use IdentityTrait;

    /**
     * @var mixed
     */
    protected $default;

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
