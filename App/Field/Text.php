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
        $name = $this->getName();
        $id = $this->getForm()->name . '__' . $name;
        $label = $this->getLabel() . ($this->getRequired() ? ' ' . $this->requiredLabelIndicator : '');
        $type = $this->getType();
        $value = $this->getSanitisedValue();

        $required = ($this->getRequired() ? ' required' : '');

        return <<<HTML
<label for="$id">$label</label>
<input type="$type" id="$id" name="$name" value="$value" $required/>
HTML;
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
