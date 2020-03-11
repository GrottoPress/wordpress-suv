<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Translations;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

abstract class AbstractTranslation extends AbstractSetup
{
    /**
     * @var string
     */
    protected $textDomain;

    protected function getTextDomain(): string
    {
        return $this->textDomain;
    }
}
