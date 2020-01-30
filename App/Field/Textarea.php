<?php

namespace App\Field;

use App\Field;

/**
 * Class Textarea
 *
 * @package App\Field
 */
class Textarea extends Field
{

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return '<label for="' . $this->getId() . '">' . $this->getLabel() . ($this->getRequired() ? ' ' . $this->requiredLabelIndicator : '') . '</label>
<textarea id="' . $this->getId() . '" name="' . $this->getName() . '"' . ($this->getRequired() ? ' required' : '' ) . $this->getAttributesHtml() . '>' . $this->getSanitisedValue() . '</textarea>';
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        // No additional validation required
        return true;
    }
}
