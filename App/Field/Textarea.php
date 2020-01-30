<?php

namespace App\Field;

use App\Field;

class Textarea extends Field
{

    public function getHtml(): string
    {
        $name = $this->getName();
        $id = $this->getForm()->name . '__' . $name;
        $label = $this->getLabel() . ($this->getRequired() ? ' ' . $this->requiredLabelIndicator : '');
        $value = $this->getSanitisedValue();

        $required = ($this->getRequired() ? ' required' : '');

        return <<<HTML
<label for="$id">$label</label>
<textarea id="$id" name="$name" $required>$value</textarea>
HTML;
    }

    public function isValid(): bool
    {
        // No additional validation required
        return true;
    }
}
