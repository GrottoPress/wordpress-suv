<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Customizer;

use GrottoPress\Getter\GetterTrait;
use WP_Customize_Manager as WPCustomizer;

abstract class AbstractPanel
{
    use GetterTrait;
    
    /**
     * @var AbstractCustomizer
     */
    protected $customizer;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var AbstractSection[]
     */
    protected $sections = [];

    protected function __construct(AbstractCustomizer $customizer)
    {
        $this->customizer = $customizer;
    }

    final protected function getCustomizer(): AbstractCustomizer
    {
        return $this->customizer;
    }

    protected function getName(): string
    {
        return $this->name;
    }

    /**
     * @return AbstractSection[]
     */
    protected function getSections(): array
    {
        return $this->sections;
    }

    /**
     * Be sure to set $this->sections HERE, in the child class.
     * Doing that in the constructor would be too early; it won't work.
     */
    public function add(WPCustomizer $WPCustomizer)
    {
        if (!$this->name) {
            return;
        }
        
        $WPCustomizer->add_panel($this->name, $this->args);

        foreach ($this->sections as $section) {
            $section->add($WPCustomizer);
        }
    }

    public function remove(WPCustomizer $WPCustomizer)
    {
        if (!$this->name) {
            return;
        }
        
        $WPCustomizer->remove_panel($this->name);
    }
}
