<?php

namespace App;

/**
 * Class Form
 *
 * @package App
 */
abstract class Form
{

    /**
     * @var string
     */
    public string $name;

    /**
     * @var Field[]
     */
    protected array $fields;

    /**
     * @var string
     */
    protected string $method = 'POST';

    /**
     * @var array
     */
    protected array $validationErrors = [];

    /**
     * Form constructor.
     *
     * @param string  $name
     * @param Field[] $fields
     */
    public function __construct(string $name, array $fields)
    {
        $this->setName($name);
        $this->addFields($fields);
    }

    /**
     * @param Field[] $fields
     *
     * @return self
     */
    public function addFields(array $fields): self
    {
        foreach ($fields as $field) {
            $field->setForm($this);

            $this->fields[$field->getName()] = $field;
        }

        return $this;
    }

    /**
     * @param Field $field
     *
     * @return self
     */
    public function addField(Field $field): self
    {
        $field->setForm($this);

        $this->fields[$field->getName()] = $field;

        return $this;
    }

    /**
     * @param string $fieldName
     *
     * @return Field
     */
    public function getField(string $fieldName): Field
    {
        return $this->fields[$fieldName];
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Form
     */
    public function setName(string $name): self
    {
        $this->name = strtolower(str_replace(['_', '-', '.', ' '], '_', trim($name, ' _-.')));

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        static $isValid;

        if ($isValid === null) {
            $isValid = true;

            foreach ($this->getFields() as $field) {
                if (!$field->isValidEssentialRules() || !$field->isValid()) {
                    $this->validationErrors[$field->getLabel()] = $field->getValidationError();

                    $isValid = false;
                }
            }
        }

        return $isValid;
    }

    /**
     * @return array|null
     */
    public function getValidationErrors(): ?array
    {
        $this->isValid();

        return $this->validationErrors;
    }

    /**
     * Returns a string containing a human-readable list of any the form submission errors encountered
     *
     * @return string|null
     */
    public function getValidationErrorsString(): ?string
    {
        $validationErrors = $this->getValidationErrors();

        if (!$validationErrors) {
            return null;
        }

        $lastError = array_pop($validationErrors);

        return implode(', ', $validationErrors) . ' and ' . $lastError . '.';
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        $method = $this->getMethod();

        $fieldHtml = '';
        foreach ($this->getFields() as $field) {
            $fieldHtml .= $field->getHtml();
        }

        return <<<HTML
<form method="$method" action="/">
$fieldHtml
<button type="submit" role="button">Submit</button>
</form>
HTML;
    }
}
