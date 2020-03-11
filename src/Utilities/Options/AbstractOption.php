<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Utilities\Options;

use GrottoPress\Getter\GetterTrait;

abstract class AbstractOption
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

    /**
     * @return mixed
     */
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

        return \get_option($this->id, $this->default);
    }

    public function add($value, bool $autoload = null): bool
    {
        return \add_option($this->id, $value, '', $autoload);
    }

    public function update($new_value, bool $autoload = null): bool
    {
        return \update_option($this->id, $new_value, $autoload);
    }

    public function delete(): bool
    {
        return \delete_option($this->id);
    }
}
