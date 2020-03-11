<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Optionizer;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractOptionizer extends AbstractSetup
{
    /**
     * @var string
     */
    protected $capability = 'manage_options';

    /**
     * @var AbstractPage[string]
     */
    protected $pages = [];

    /**
     * @var AbstractSection[string]
     */
    protected $sections = [];

    /**
     * @var AbstractSetting[string]
     */
    protected $settings = [];

    /**
     * @var AbstractField[string]
     */
    protected $fields = [];

    protected function getCapability(): string
    {
        return $this->capability;
    }

    /**
     * @return AbstractPage[string]
     */
    protected function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @return AbstractSection[string]
     */
    protected function getSections(): array
    {
        return $this->sections;
    }

    /**
     * @return AbstractSetting[string]
     */
    protected function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @return AbstractField[string]
     */
    protected function getFields(): array
    {
        return $this->field;
    }

    /**
     * Be sure to set `$this->pages`, `$this->sections`,
     * `$this->settings`, `$this->fields` HERE, in the child class.
     * Doing so in the constructor may be too early; it mighty not work.
     *
     * @action admin_menu
     */
    public function add()
    {
        if ($this->capability && !\current_user_can($this->capability)) {
            return;
        }

        $this->addPages();
        $this->addSections();
        $this->addSettings();
        $this->addFields();
    }

    private function addPages()
    {
        \array_walk(
            $this->pages,
            function (AbstractPage $page, string $key) {
                $page->add();
            }
        );
    }

    private function addSections()
    {
        \array_walk(
            $this->sections,
            function (AbstractSection $section, string $key) {
                $section->add();
            }
        );
    }

    private function addSettings()
    {
        \array_walk(
            $this->settings,
            function (AbstractSetting $setting, string $key) {
                $setting->add();
            }
        );
    }

    private function addFields()
    {
        \array_walk(
            $this->fields,
            function (AbstractField $field, string $key) {
                $field->add();
            }
        );
    }
}
