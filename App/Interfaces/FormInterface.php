<?php

namespace App\Interfaces;

use App\Field;

interface FormInterface
{

    /**
     * @param Field[] $fields
     *
     * @return self
     */
    public function addFields(array $fields): self;

    /**
     * @param Field $field
     *
     * @return self
     */
    public function addField(Field $field): self;

    /**
     * @param string $fieldName
     *
     * @return Field
     */
    public function getField(string $fieldName): Field;

    /**
     * @return bool
     */
    public function isValid(): bool;
}
