<?php

namespace App\Field;

use App\Field;

/**
 * Class Text
 *
 * @package App\Field
 */
class Text extends Field
{

    /**
     * @var string
     */
    protected string $type = 'text';

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return '<label for="' . $this->getId() . '">' . $this->getLabel() . '</label>
<input type="' . $this->getType() . '" id="' . $this->getId() . '" name="' . $this->getName() . '" value="' . $this->getSanitisedValue() . '"' . ($this->getRequired() ? ' required' : '' ) . $this->getAttributesHtml() . '/>';
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        // No additional validation required
        return true;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
