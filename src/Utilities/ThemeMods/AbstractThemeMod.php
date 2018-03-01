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
    protected $name;

    /**
     * @var mixed
     */
    protected $default;

    protected function getName(): string
    {
        return $this->name;
    }

    protected function getDefault()
    {
        return $this->default;
    }

    public function get()
    {
        if (!$this->name) {
            \settype($null, \gettype($this->default));
            
            return $null;
        }

        return \get_theme_mod($this->name, $this->default);
    }

    public function update($newValue): bool
    {
        if (!$this->name) {
            return false;
        }

        return \set_theme_mod($this->name, $newValue);
    }

    public function delete()
    {
        if (!$this->name) {
            return;
        }

        \remove_theme_mod($this->name);
    }
}
