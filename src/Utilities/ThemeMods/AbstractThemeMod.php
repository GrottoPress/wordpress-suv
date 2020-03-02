<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Utilities\ThemeMods;

use GrottoPress\Getter\GetterTrait;

class AbstractThemeMod
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
            \settype($value, \gettype($this->default));

            return $value;
        }

        return \get_theme_mod($this->id, $this->default);
    }

    public function update($new_value): bool
    {
        if (!$this->id) {
            return false;
        }

        return \set_theme_mod($this->id, $new_value);
    }

    public function delete()
    {
        if (!$this->id) {
            return;
        }

        \remove_theme_mod($this->id);
    }
}
