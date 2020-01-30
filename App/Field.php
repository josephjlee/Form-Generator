<?php

namespace App;

use App\Interfaces\FieldInterface;

/**
 * Class Field
 *
 * @package App\Field
 */
abstract class Field implements FieldInterface
{

    protected string $name;

    protected ?string $value = null;

    protected string $label;

    protected array $attributes = [];

    protected string $requiredLabelIndicator = '*';

    protected bool $required = true;

    protected int $minLength;

    protected int $maxLength;

    protected string $validationError;

    protected bool $sensitiveContents = false;

    protected Form $form;

    /**
     * Field constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;

        $this->setLabelFromName();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->getForm()->name . '__' . $this->getName();
    }

    /**
     * @return bool
     */
    public function isValidEssentialRules(): bool
    {
        if ($this->getRequired() && $this->getValue() === null) {
            $this->setValidationError($this->getLabel() . ' is a required field');

            return false;
        }

        if ($this->getMaxLength() && mb_strlen($this->getValue()) > $this->getMaxLength()) {
            $this->setValidationError($this->getLabel() . ' is too long, maximum length: ' . $this->getMaxLength());

            return false;
        }

        if ($this->getMinLength() && mb_strlen($this->getValue()) < $this->getMinLength()) {
            $this->setValidationError($this->getLabel() . ' is too short, minimum length: ' . $this->getMaxLength());

            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getValidationError(): string
    {
        return $this->validationError;
    }

    /**
     * @param string $validationError
     */
    protected function setValidationError(string $validationError): void
    {
        $this->validationError = $validationError;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSanitisedValue(): string
    {
        return filter_var($this->value, FILTER_SANITIZE_STRIPPED);
    }

    /**
     * @return string
     */
    public function getRawValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     *
     * @return self
     */
    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return int
     */
    public function getMinLength(): int
    {
        return $this->minLength;
    }

    /**
     * @param int $minLength
     */
    public function setMinLength(int $minLength): void
    {
        $this->minLength = $minLength;
    }

    /**
     * @return int
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     */
    public function setMaxLength(int $maxLength): void
    {
        $this->maxLength = $maxLength;
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     *
     * @return self
     */
    public function setForm(Form $form): self
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return self
     */
    protected function setLabelFromName(): self
    {
        $label = ucfirst(str_replace(['_', '-', '.'], ' ', trim($this->getName(), ' .-_')));

        $this->setLabel($label);

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function getAttributesHtml(): string
    {
        $attributes = [];
        foreach ($this->attributes as $attribute => $value) {
            $attributes[] = $attribute . '="' . htmlspecialchars($value) . '"';
        }

        return ' ' . implode(' ', $attributes);
    }

    /**
     * @param string $attribute
     * @param string $value
     *
     * @return Field
     */
    public function setAttribute(string $attribute, string $value): self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return Field
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }
}
